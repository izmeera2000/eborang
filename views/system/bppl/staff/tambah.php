<!--
=========================================================
* Soft UI Dashboard 3 - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/head.php"); ?>


<body class="g-sidenav-show  bg-gray-100">

    <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/sidenav.php"); ?>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/navbar.php"); ?>

        <!-- End Navbar -->
        <div class="container-fluid my-3 py-3">
            <div class="row mb-5">
                <form method="POST" enctype="multipart/form-data">


                    <div class="col-12">

                        <div class="row">

                            <!-- Card Basic Info -->
                            <div class="card mt-4" id="basic-info">
                                <div class="card-header">
                                    <h5>Maklumat</h5>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Nama</label>
                                            <div class="input-group">
                                                <input name="nama" class="form-control" type="text"
                                                    placeholder="Masukkan Nama Penuh (Contoh: Alec Johnson)"
                                                    required="required" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">IC</label>
                                            <div class="input-group">
                                                <input name="ic" class="form-control" type="text"
                                                    placeholder="Masukkan Nombor IC (Contoh: 2324253351)"
                                                    required="required" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label mt-4">Birth Date</label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="date" id="example-date-input"
                                                            name="birth_date" required placeholder="Pilih Tarikh Lahir">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label mt-4">Email</label>
                                            <div class="input-group">
                                                <input id="email" name="email" class="form-control" type="email"
                                                    placeholder="Masukkan Email (Contoh: example@email.com)"
                                                    onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label mt-4">Phone Number</label>
                                            <div class="input-group">
                                                <input id="phone" name="phone" class="form-control" type="number"
                                                    placeholder="Masukkan Nombor Telefon (Contoh: 01123482315)"
                                                    onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <!-- Card Change Password -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5>Maklumat Uni</h5>
                                    </div>
                                    <div class="card-body pt-0">

                                        <div class="row">


                                            <div class="col-6">
                                                <label class="form-label mt-4">Bengkel</label>
                                                <div class="input-group">
                                                    <select name="bengkel" class="form-control" onfocus="focused(this)"
                                                        onfocusout="defocused(this)" required>
                                                        <option value="" disabled selected>Select Bengkel</option>
                                                        <option value="komputer">Komputer</option>
                                                        <option value="mekatronik">Mekatronik</option>
                                                        <option value="mikroelektrik">Mikroelektrik</option>
                                                        <option value="polimer">Polimer</option>
                                                        <option value="mekanikal bahan">Mekanikal Bahan</option>
                                                        <option value="jaminan kualiti">Jaminan Kualiti</option>
                                                        <option value="komposit">Komposit</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label mt-4">Role</label>
                                                <div class="input-group">
                                                    <select name="role" class="form-control" onfocus="focused(this)"
                                                        onfocusout="defocused(this)" required>
                                                        <option value="" disabled selected>Select Role</option>
                                                        <option value="1">BPPL</option>
                                                        <option value="2">KB</option>
                                                        <option value="3">Lecturer</option>
                                                        <option value="4">Guard</option>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>




                                    </div>
                                </div>
                            </div>




                            <div class="row">

                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5>Gambar</h5>
                                    </div>
                                    <div class="card-body pt-0">


                                        <div class="col-12">
                                            <label class="form-label">Profile Picture</label>
                                            <div class="input-group">
                                                <input type="file" name="profile_picture" class="form-control">
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5>Password</h5>
                                    </div>
                                    <div class="card-body pt-0">

                                        <h5 class=" ">Password requirements</h5>
                                        <p class="text-muted mb-2">
                                            Please follow this guide for password:
                                        </p>
                                        <div class="row ps-4">

                                            <ul class="text-muted  mb-0 float-start">
                                                <li>
                                                    <span class="text-sm">IC</span>
                                                </li>


                                            </ul>
                                        </div>

                                        <div class="row">
                                            <p class="text-muted mb-2 mt-2">
                                                User will be needed to change their passwords after first login
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-2  ">

                                    <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0" type="submit"
                                        name="staffadd">Tambah</button>
                                </div>

                            </div>

                </form>





            </div>

        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/footer2.php"); ?>

        </div>
    </main>


    <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/script.php"); ?>

 


</body>

</html>