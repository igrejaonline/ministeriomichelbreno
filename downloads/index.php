
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Materiais - Ministério Michel Breno</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; text-align: center; padding: 20px; }
        .grid { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; max-width: 1200px; margin: 0 auto; }
        .card { background: white; padding: 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 280px; display: flex; flex-direction: column; align-items: center; }
        .card img { width: 100%; height: auto; border-radius: 5px; margin-bottom: 15px; object-fit: cover; aspect-ratio: 1/1.4; }
        .btn { background: #000; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; width: 80%; display: block; }
        .btn:hover { background: #333; }
        h1 { color: #333; margin-bottom: 30px; }
    </style>
</head>
<body>

    <h1>📚 Biblioteca de Estudos</h1>

    <div class="grid">
        <?php
        // Caminho da pasta de arquivos (voltando um nível e entrando em files)
        $dir = '../files/';
        
        // Pega todos os arquivos PDF
        $files = glob($dir . '*.pdf');
        
        // Ordena para mostrar os mais recentes primeiro
        array_multisort(array_map('filemtime', $files), SORT_DESC, $files);

        foreach($files as $file) {
            // Pega apenas o nome do arquivo (ex: ministerios.pdf)
            $filename = basename($file);
            // Pega o nome sem extensão (ex: ministerios)
            $nameWithoutExt = pathinfo($file, PATHINFO_FILENAME);
            // Caminho para o download
            $downloadLink = "https://ministeriomichelbreno.com.br/files/" . $filename;
            
            // Verifica se existe uma imagem .jpg ou .png com o mesmo nome
            $imagePath = $dir . $nameWithoutExt . ".jpg";
            $displayImage = "https://ministeriomichelbreno.com.br/files/" . $nameWithoutExt . ".jpg";
            
            // Se não tiver imagem, usa uma genérica (opcional)
            if (!file_exists($imagePath)) {
                // Aqui você pode por um link de uma imagem padrão cinza se quiser
                $displayImage = "https://via.placeholder.com/300x400?text=PDF+Sem+Capa"; 
            }
            ?>

            <div class="card">
                <img src="<?php echo $displayImage; ?>" alt="Capa do Material">
                <h3 style="text-transform: capitalize;"><?php echo str_replace('_', ' ', $nameWithoutExt); ?></h3>
                <a href="<?php echo $downloadLink; ?>" class="btn" download>BAIXAR AGORA</a>
            </div>

        <?php } ?>
    </div>

</body>
</html>
