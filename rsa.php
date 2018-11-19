<?php
    $n = $e = $d = 0;
    $cipher_data = '';
    $plain_data = '';

    if (isset($_GET["e"]) && isset($_GET["d"]) && isset($_GET["n"])) {
        $e = $_GET["e"];
        $n = $_GET["n"];
        $d = $_GET["d"];
    }

    if (isset($_POST["encrypt"])) {
        $n = $_POST["n"];
        $e = $_POST["e"];
        $d = $_POST["d"];
        $plaintext = $_POST["plaintext"];
        
        if (empty($plaintext)) {
            echo "<script>alert('โปรดกรอกข้อมูล');
            window.location.href = window.location.href + '?e=$e&n=$n&d=$d';</script>";
            exit();
        }
        else {
            if (!is_numeric($plaintext)) {
                echo "<script>alert('โปรดกรอกข้อมูลเป็นตัวเลข (ตัวอักษรกำลังอยู่ในระหว่างการพัฒนา...)');
                window.location.href = window.location.href + '?e=$e&n=$n&d=$d';</script>";
                exit();
            }
            else {
                $cipher_data = encrypt((int)$plaintext, $e, $n);
            }
        }
    }

    if (isset($_POST["decrypt"])) {
        $n = $_POST["n"];
        $e = $_POST["e"];
        $d = $_POST["d"];
        $ciphertext = $_POST["ciphertext"];

        if (empty($ciphertext)) {
            echo "<script>alert('โปรดกรอกข้อมูล');
            window.location.href = window.location.href + '?e=$e&n=$n&d=$d';</script>";
            exit();
        }
        else {
            if (!is_numeric($ciphertext)) {
                echo "<script>alert('โปรดกรอกข้อมูลเป็นตัวเลข (ตัวอักษรกำลังอยู่ในระหว่างการพัฒนา...)');
                window.location.href = window.location.href + '?e=$e&n=$n&d=$d';</script>";
                exit();
            }
            else {
                $plain_data = decrypt((int)$ciphertext, $d, $n);
            }
        }
    }
    function encrypt($message, $e, $n) {
        return pow($message, $e) % $n;
    }
    function decrypt($ciphertext, $d, $n) {
        // return pow($ciphertext, $d) % $n;
        return bcpowmod($ciphertext, $d, $n);
    }
?>
<?php include 'layout/header.php'; ?>
<body>
    <div class="container">
        <div class="key">
            <br/><br/>
            <div class="key-pub-pri">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;" id="pub">
                    <div class="card-header">Public Key</div>
                    <div class="card-body">
                        <h4>(n, e) &#8594; (<?php echo $n; ?>, <?php echo $e; ?>)</h4>
                    </div>
                </div>
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;" id="pri">
                    <div class="card-header">Private Key</div>
                    <div class="card-body">
                        <h4>(n, d) &#8594; (<?php echo $n; ?>, <?php echo $d; ?>)</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-en">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <a href="index.php" class="btn btn-danger">สร้างคีย์</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        หลักการทำงานของ RSA
                    </button>
                </div>
                <div class="form-group">
                    <label>ใส่ข้อความเพื่อเข้ารหัส</label>
                    <input type="hidden" name="n" value="<?php echo $n; ?>">
                    <input type="hidden" name="e" value="<?php echo $e; ?>">
                    <input type="hidden" name="d" value="<?php echo $d; ?>">
                    <input type="text" name="plaintext" class="form-control" autocomplete="off">
                </div>
                <input type="submit" value="เข้ารหัส" name="encrypt" class="btn btn-primary">
            </form>

            <br/>
            <?php if(!empty($cipher_data)): ?>
                <div class="alert alert-primary" role="alert">
                    <h4>ข้อความที่เข้ารหัสแล้วคือ <strong><?php echo $cipher_data; ?></strong></h4>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-de">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label>ใส่ข้อความเพื่อถอดรหัส</label>
                    <input type="hidden" name="n" value="<?php echo $n; ?>">
                    <input type="hidden" name="e" value="<?php echo $e; ?>">
                    <input type="hidden" name="d" value="<?php echo $d; ?>">
                    <input type="text" name="ciphertext" class="form-control" autocomplete="off">
                </div>
                <input type="submit" value="ถอดรหัส" name="decrypt" class="btn btn-primary">
            </form>

            <br/>
            <?php if(!empty($plain_data)): ?>
                <div class="alert alert-primary" role="alert">
                    <h4>ข้อความที่ถอดรหัสแล้วคือ <strong><?php echo $plain_data; ?></strong></h4>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'layout/footer.php' ?>