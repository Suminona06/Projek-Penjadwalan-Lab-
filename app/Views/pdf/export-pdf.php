<table border="1">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">No Pc</th>
            <th scope="col">Nama PC</th>
            <th scope="col">Windows</th>
            <th scope="col">Processor</th>
            <th scope="col">Ram</th>
            <th scope="col">Mouse</th>
            <th scope="col">Keyboard</th>
        </tr>

    <tbody>
        <?php
        $i = 1
            ?>
        <?php foreach ($model as $model): ?>
            <tr class="text-center">
                <td scope="row">
                    <?= $i++; ?>
                </td>
                <td>
                    <?= $model['no_pc']; ?>
                </td>
                <td>
                    <?= $model['nama_pc']; ?>
                </td>
                <td>
                    <?= $model['windows']; ?>
                </td>
                <td>
                    <?= $model['processor']; ?>
                </td>
                <td>
                    <?= $model['ram']; ?>
                </td>
                <td>
                    <?= $model['mouse']; ?>
                </td>
                <td>
                    <?= $model['keyboard']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>