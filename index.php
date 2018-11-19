<?php
    require 'math.php';
    $n = 0;
    $phi_function = 0;
    $find_d_status = false;
    if (isset($_POST["submit"])) {
        $primeNumber1 = htmlspecialchars($_POST["primeNumber-1"]);
        $primeNumber2 = htmlspecialchars($_POST["primeNumber-2"]);
        if (empty($primeNumber1) || empty($primeNumber2)) {
            echo "<script>alert('โปรดใส่ข้อมูล');location=location;</script>";
            exit();
        }
        else {
            if (!is_numeric($primeNumber1) || !is_numeric($primeNumber2)) {
                echo "<script>alert('โปรดใส่ข้อมูลเป็นตัวเลข');location=location;</script>";
                exit();
            }
            else {
                if (!is_prime($primeNumber1)) {
                    echo "<script>alert('$primeNumber1 ไม่ใช่จำนวนเฉพาะ');location=location;</script>";
                    exit();
                }
                if (!is_prime($primeNumber2)) {
                    echo "<script>alert('$primeNumber2 ไม่ใช่จำนวนเฉพาะ');location=location;</script>";
                    exit();
                }
                $n = $primeNumber1 * $primeNumber2;
                $phi_function = ($primeNumber1 - 1) * ($primeNumber2 - 1);
            }
        }
    }
    if (isset($_GET["e"]) && isset($_GET["phi"])) {
        $e = $_GET["e"];
        $phi_function = $_GET["phi"];
        $n = $_GET["n"];
        // $d = find_d($e, $phi_function);
        $find_d_status = true;
    }
    
?>
<?php include 'layout/header.php'; ?>
<body>
    <div class="container">
        <div class="form">
            <h1>RSA ขั้นตอนการสร้างกุญแจเพื่อนำไปใช้เข้ารหัสและถอดรหัส</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="form-group">
                    <label>จำนวนเฉพาะตัวที่หนึ่ง</label>
                    <input type="text" name="primeNumber-1" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>จำนวนเฉพาะตัวที่สอง</label>
                    <input type="text" name="primeNumber-2" class="form-control" autocomplete="off">
                </div>
                <input type="submit" value="คำนวณ" name="submit" class="btn btn-primary">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    หลักการทำงานของ RSA
                </button>
            </form>
        </div>

        <?php if($phi_function !== 0 && !$find_d_status): ?>
            <h3>ผลคูณของจำนวนเฉพาะสองจำนวนคือ <span><?php echo $n;?></span></h3>
            <h3>ค่า Phi function ของ <?php echo $n; ?> คือ <span><?php echo $phi_function; ?></span></h3>
            <br/>
            <h4>เลือกจำนวนเต็ม e มาหนึ่งจำนวน โดย e เป็นจำนวนเฉพาะสัมพัทธ์กับค่า Phi Function = <?php echo $phi_function; ?> และ 1 < e < <?php echo $phi_function; ?> ได้แก่</h4>
            <div class="e-list">
                <?php for($i = 2; $i < $phi_function; $i++): ?>
                    <?php if (gcd($i, $phi_function) === 1): ?>
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>?e=<?php echo $i;?>&phi=<?php echo $phi_function;?>&n=<?php echo $n;?>"><?php echo $i; ?></a>
                        <!-- <br/> -->
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <?php if($phi_function !== 0 && $find_d_status): ?>
            <h4>เลือกจำนวนเต็ม d มาหนึ่งจำนวน โดย d มาจากสมการ e x d mod Phi(n) = 1</h4>
            <br/>
            <div class="d-list">
                <?php $i = 0; $count = 0;?>
                <?php while (true):?>
                    <?php $result = ($phi_function * $i + 1) / $e; ?>
                    <?php if (is_int($result)): ?>
                        <?php $d = $result; $count++;?>
                        <a href="rsa.php?e=<?php echo $e;?>&d=<?php echo $d;?>&n=<?php echo $n;?>"><?php echo $d; ?></a>
                    <?php endif; ?>
                    <?php if ($count > 15) break;?>
                <?php $i++; ?>
                <?php endwhile; ?>
                <a href="#">...</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'layout/footer.php' ?>    