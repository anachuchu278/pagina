<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/crud.css');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos</title>
</head>
<body>
    <table>
    <?php if (!empty($turnos)): ?>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Medico</th>
                <th>Especialidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($turnos as $turno) :?>
                <tr>
                    <td><?= $turno['fecha_hora'];?></td>
                    <td><?= $turno['id_usuario'];?></td>
                    <td>
                        <a href="<?= site_url('editarTurno/'. $turno->id_Turno);?>">Reprogramar Turno</a>
                        <a href="<?= site_url('cancelarTurno/'. $turno->id_Turno);?>">Cancelar Turno</a>
                        <a href="<?= site_url('PDFTurno/'. $turno->id_Turno);?>">Descargar PDF</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    <?php else: ?>
        <p>No tiene turnos reservados.</p>
    <?php endif; ?>
    </table>
    <div class="box-new">
        <a href="newTurno"><button class="new" >Pedir Turno</button></a>
    </div>
</body>
</html>
