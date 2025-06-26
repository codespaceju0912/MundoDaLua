<?php
include("../paginas/loginBD.php");

$sql = "SELECT * FROM produto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Estoque</th>
                <th>Valor</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
          </thead>
          <tbody>';

    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["idProdt"] . '</td>';
        echo '<td>' . $row["dscProdt"] . '</td>';
        echo '<td>' . $row["dscDetalProdt"] . '</td>';
        echo '<td>' . $row["qtdAtualEstqProdt"] . '</td>';
        echo '<td>R$ ' . number_format($row["valProdt"], 2, ',', '.') . '</td>';
        
        // Se houver imagem cadastrada
        if (!empty($row["urlImagemProdt"])) {
            echo '<td><img src="' . $row["urlImagemProdt"] . '" width="80"></td>';
        } else {
            echo '<td>Sem imagem</td>';
        }

        echo '<td>
                <form action="produtoController.php" method="POST" style="display:inline;">
                    <input type="hidden" name="idProdt" value="' . $row["idProdt"] . '">
                    <button type="submit" name="acao" value="editar">Editar</button>
                </form>
                <form action="produtoController.php" method="POST" style="display:inline;">
                    <input type="hidden" name="idProdt" value="' . $row["idProdt"] . '">
                    <button type="submit" name="acao" value="excluir" onclick="return confirm(\'Tem certeza que deseja excluir?\')">Excluir</button>
                </form>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo "<p>Nenhum produto cadastrado.</p>";
}

$conn->close();
?>