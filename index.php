<?php
// Processa a geração da senha
if (isset($_POST['generate'])) {
    $length = isset($_POST['length']) ? intval($_POST['length']) : 12;
    $include_special_chars = isset($_POST['special_chars']) ? true : false;

    function generatePassword($length, $include_special_chars) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($include_special_chars) {
            $characters .= '!@#$%^&*()_-+=<>?';
        }

        $characters_length = strlen($characters);
        $random_password = '';

        for ($i = 0; $i < $length; $i++) {
            $random_password .= $characters[rand(0, $characters_length - 1)];
        }

        return $random_password;
    }

    $password = generatePassword($length, $include_special_chars);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerador de Senhas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'form.html'; ?>

<?php if (isset($password)) { ?>
    <div class="result">
        <h3>Senha Gerada:</h3>
        <input type="text" id="generated_password" value="<?php echo $password; ?>" readonly>
        <button onclick="copyToClipboard()">Copiar</button>
    </div>
<?php } ?>

<script>
function copyToClipboard() {
    var copyText = document.getElementById("generated_password");
    copyText.select();
    document.execCommand("copy");
    alert("Senha copiada para a área de transferência!");
}
</script>

</body>
</html>
