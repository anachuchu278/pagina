#include <Adafruit_GFX.h>
#include <Adafruit_ST7735.h>
#include "qrcodem.h"
#include <WiFi.h>
// TFT display use software SPI interface.
// #define TFT_MOSI 11  // Data out
// #define TFT_SCLK 12  // Clock out

#define TFT_CS  7  // Chip select line for TFT display
#define TFT_DC   2 // Data/command line for TFT
#define TFT_RST  3  // Reset line for TFT (or connect to VCC)
#define ssid "placa"
#define pass "12345678"

Adafruit_ST7735 tft_ST7735 = Adafruit_ST7735(TFT_CS, TFT_DC, TFT_RST);

void setup() {
    delay(1000);
    Serial.begin(115200);
    delay(1000);
    while (!Serial) { }

  Serial.print("Attempting to connect to SSID: ");
  Serial.println(ssid);

  WiFi.useStaticBuffers(true);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, pass);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  delay(1000);

  Serial.println("");
  Serial.println("Connected to WiFi");
    Serial.println("- setup() started -");
    tft_ST7735.initR(INITR_BLACKTAB);
    tft_ST7735.setRotation(2);
    
    // tft display RGB to make sure it's work properly
    tft_ST7735.fillScreen(ST7735_BLACK);
    delay(300);
    tft_ST7735.fillScreen(ST7735_RED);
    delay(300);
    tft_ST7735.fillScreen(ST7735_GREEN);
    delay(300);
    tft_ST7735.fillScreen(ST7735_BLUE);
    delay(300);
    tft_ST7735.fillScreen(ST7735_WHITE);
    delay(300);

    // Start time
    uint32_t dt = millis();
  
    // Create the QR code
    QRCode qrcode;

    const char *data = "http://192.168.1.147/pagina/public/";
    const uint8_t ecc = 0;  //lowest level of error correction
    const uint8_t version = 3;

    uint8_t qrcodeData[qrcode_getBufferSize(version)];
    qrcode_initText(&qrcode, 
                    qrcodeData, 
                    version, ecc, 
                    data);
  
    // Delta time
    dt = millis() - dt;
    Serial.print("QR Code Generation Time: ");
    Serial.print(dt);
    Serial.print("\n\n");
    
    Serial.println(data);
    Serial.print("qrcode.version: ");
    Serial.println(qrcode.version);
    Serial.print("qrcode.ecc: ");
    Serial.println(qrcode.ecc);
    Serial.print("qrcode.size: ");
    Serial.println(qrcode.size);
    Serial.print("qrcode.mode: ");
    Serial.println(qrcode.mode);
    Serial.print("qrcode.mask: ");
    Serial.println(qrcode.mask);
    Serial.println();

    const int xy_scale = 3;
    const int x_offset = (tft_ST7735.width() - xy_scale*qrcode.size)/2;
    const int y_offset = (tft_ST7735.height() - xy_scale*qrcode.size)/2;
    
    
    // Top quiet zone
    Serial.print("\n\n\n\n");
    for (uint8_t y = 0; y < qrcode.size; y++) {

        // Left quiet zone
        Serial.print("        ");

        // Each horizontal module
        for (uint8_t x = 0; x < qrcode.size; x++) {

            // Print each module (UTF-8 \u2588 is a solid block)
            bool mod = qrcode_getModule(&qrcode, x, y);
            //Serial.print(mod ? "\u2588\u2588": "  ");
            if(mod){
              Serial.print("██"); //same as "\u2588\u2588"
                                  //direct paste "██" copied from Serial Monitor
              int px = x_offset + (x * xy_scale);
              int py = y_offset + (y * xy_scale);
              tft_ST7735.fillRect(px, py, xy_scale, xy_scale, ST7735_BLACK);
              
            }else{
              Serial.print("  ");
            }
        }

        Serial.print("\n");
    }

    // Bottom quiet zone
    Serial.print("\n\n\n\n");
}

void loop() {

}