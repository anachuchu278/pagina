<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/crud.css')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <>
        <thead>
        <tr>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Horarios</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($medicos as $medico): ?>
            <tr>
                <td><?= $medico['nombre']; ?></td>
                <td><?= $medico['email']; ?></td>
                <td><?= $medico['horarios']; ?></td>
                <td>
                    <a class="editar" href="<?= site_url('editMedico/'. $medico['id_Medico']); ?>">Editar</a>
                    <a class="delete" href="<?= site_url('eliminarMedico/'. $medico['id_Medico']); ?>">Eliminar</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach;?>
    </table>
    <div class="box-new">
        <a class="new" href="newMedicoView">Añadir</a><br>
    </div>
</body>
</html>
