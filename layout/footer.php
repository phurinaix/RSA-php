<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">หลักการทำงานของ RSA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    RSA เป็นระบบเข้ารหัสแบบกุญแจอสมมาตรที่ถูกใช้กันอย่างแพร่หลาย
                    <p><b><u>การทำงานของ RSA</u></b></p>
                    <br/>
                    <p><b>ขั้นตอนการสร้างคีย์ (Key Generation Algorithm)</b></p>
                    <ol>
                        <li>เลือกเลขจำนวนเฉพาะสองตัวขนาดเท่ากัน กำหนดเป็น p และ q</li>
                        <li>คำนวณ n = p x q</li>
                        <li>คำนวณ Phi_function(n) = (p - 1)(q - 1)</li>
                        <li>เลือกจำนวนเต็ม e ที่เป็นจำนวนเฉพาะสัมพัทธ์กับ ค่า Phi_function</li>
                        <li>เลือกจำนวนเต็ม d ที่มีคุณสมบัติคือ (e x d) mode Phi_function(n) = 1</li>
                        <li>กุญแจสาธารณะคือคู่อันดับ (n, e) และกุญแจส่วนตัวคือคู่อันดับ(n, d)</li>
                    </ol>
                    <br/>
                    <p><b>ขั้นตอนการเข้ารหัส (Encryption)</b></p>
                    <p>
                        รับกุญแจสาธารณะ (n, e) จากขั้นตอนการสร้างคีย์และเปลี่ยนข้อความต้นฉบับ (P) ให้อยู่ในรูปของจำนวน
                        เต็มที่น้อยกว่า n และคำนวณข้อความเข้ารหัส (C) ด้วยสมการ
                    </p>
                    <p style="text-align: center; color: red;"><b>C = P<sup>e</sup> mod n</b></p>
                    <br/>
                    <p><b>ขั้นตอนการถอดรหัส (Decryption)</b></p>
                    <p>
                        รับกุญแจสาธารณะ (n, d) จากขั้นตอนการสร้างคีย์และรับข้อความเข้ารหัส C คำนวณข้อความต้นฉบับด้วยสมการ
                    </p>
                    <p style="text-align: center; color: red;"><b>P = C<sup>d</sup> mod n</b></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>