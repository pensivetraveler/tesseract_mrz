<?php
$python = "/var/www/tesseract_dev/venv/bin/python3.8";
$script = "/var/www/cwspecial_dev/tesseract/main.py";

$output = "";
$imagePath = "";
if($_POST['sample']) {
    $imagePath = "/var/www/cwspecial_dev/tesseract/passport_mrz.jpg";
}else{
//    print_r('<pre>');
//    print_r($_FILES);
//    print_r('</pre>');
//    exit;
}

if($imagePath) {
    $command = escapeshellcmd("$python $script $imagePath");
    $output = shell_exec($command);
}
?>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h2>Tesseract Test</h2>
        <form name="frm" action="/tesseract/index.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sample" value="">
<!--            <div>-->
<!--                <h4>직접 업로드</h4>-->
<!--                <br>-->
<!--                <input type="file" value="" accept="image/*"><button class="submit">OCR 실행</button>-->
<!--            </div>-->
<!--            <hr style="margin-top:20px;">-->
            <div>
                <h4>샘플링</h4>
                <div>
                    <img src="https://cw.thefit.io/tesseract/passport_mrz.jpg" alt="">
                </div>
                <br>
                <button id="sampleOCR" type="button">샘플 이미지 OCR</button>
            </div>
            <?php if ($output): ?>
            <div>
                <h4>결과</h4>
                <?="<pre>OCR Result:\n$output</pre>";?>
                <button id="resetOCR" type="reset">초기화</button>
            </div>
            <?php endif; ?>
        </form>
        <script>
            document.getElementById('sampleOCR').addEventListener('click', function(e) {
                document.frm.sample.value = 1;
                document.frm.submit();
            });
            if(document.getElementById('resetOCR') !== null){
                document.getElementById('resetOCR').addEventListener('click', function(e) {
                    document.frm.sample.value = '';
                    document.frm.submit();
                });
            }
        </script>
    </body>
</html>
