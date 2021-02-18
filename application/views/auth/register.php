<!-- Page breadcrumb -->
<section id="mu-page-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="mu-page-breadcrumb-area">
					<h2>Pendaftaran</h2>
					<ol class="breadcrumb">
						<li><a href="<?=base_url("home")?>">Beranda</a></li>
						<li class="active">Pendaftaran</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End breadcrumb -->

<!-- Start contact  -->
<section id="mu-contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="mu-contact-area">
					<!-- start contact content -->
					<div class="mu-contact-content">
						<div class="row">
							<div class="col-md-6">
								<div class="mu-contact-left">
                                    <form 
                                        id="contactform"
                                        role="form" class="contactform form-horizontal action-create"
                                        data-action="<?=base_url("register/add")?>">

										<p class="comment-form-author">
											<label for="author">Nama <span class="required">*</span></label>
                                            <input type="text"  id="name" name="name">
                                            <span class="help-block form-error" id="name-error"></span>
                                        </p>
                                        
                                        <p class="comment-form-author">
											<label for="author">Tempat Lahir <span class="required">*</span></label>
                                            <input type="text" id="birth_place" name="birth_place">
                                            <span class="help-block form-error" id="birth_place-error"></span>
                                        </p>

                                        <p class="comment-form-author">
											<label for="author">Tanggal Lahir <span class="required">*</span></label>
                                            <input readonly type="text" placeholder="Contoh: 28-09-1993" id="birth_date" name="birth_date"
                                                value="<?=date('d-m-Y')?>"
                                                data-date="01-01-1999" 
                                                data-date-format="dd-mm-yyyy" 
                                                data-date-viewmode="months">
                                            <span class="help-block form-error" id="birth_date-error"></span>
                                        </p>

                                        <p class="comment-form-author">
											<label for="author">Jenis Kelamin</label>
                                            <select class="form-control" name="gender" id="gender">
                                            <?php 
                                                $genders = ["Laki - Laki", "Perempuan"];
                                                foreach ($genders as $gender) {
                                                    echo "<option value='$gender'>$gender</option>";
                                                }
                                            ?>
                                            </select>
                                        </p>

                                        <p class="comment-form-message">
											<label for="author">Alamat <span class="required">*</span></label>
                                            <textarea type="text" id="address" name="address"></textarea>
                                            <span class="help-block form-error" id="address-error"></span>
                                        </p>

                                        <p class="comment-form-author">
											<label for="author">Nomor Telpon <span class="required">*</span></label>
                                            <input class="mask_phone" type="text" placeholder="Contoh: 0888-9999-9999" id="phone" name="phone">
                                            <span class="help-block form-error" id="phone-error"></span>
                                        </p>

                                        <p class="comment-form-author">
											<label for="author">Email <span class="required">*</span></label>
                                            <input type="text" id="email" name="email">
                                            <span class="help-block form-error" id="email-error"></span>
                                        </p>

                                        <p class="comment-form-author">
											<label for="author">Jurusan</label>
                                            <input type="text" id="major" name="major">
                                            <span class="help-block form-error" id="major-error"></span>
                                        </p>

                                        <p class="comment-form-author">
											<label for="author">Kelas</label>
                                            <select class="form-control" name="class_id" id="class_id">
                                            <?php 
                                                foreach ($classes as $class) {
                                                    echo "<option value='$class->id'>$class->classname</option>";
                                                }
                                            ?>
                                            </select>
                                        </p>

                                        <p class="comment-form-author">
											<label for="author">Semester</label>
                                            <select class="form-control" name="semester_id" id="semester_id">
                                            <?php 
                                                foreach ($semesters as $semester) {
                                                    echo "<option value='$semester->id'>$semester->semester_name</option>";
                                                }
                                            ?>
                                            </select>
                                        </p>

										<p class="form-submit">
											<input type="submit" value="Daftar" class="mu-post-btn" name="submit">
										</p>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- end contact content -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End contact  --> 