<?php 
if( !(isset($ld)) ) {
    $ld = "./";
}
?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">

        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#nvyta">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $ld; ?>"><img src="<?php echo $ld.ASSETS_IMGS; ?>lms-logo-med.png" width="25" height="25" /></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="nvyta">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo $ld; ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="<?php echo $ld; ?>catalogue/"><span class="glyphicon glyphicon-book"></span> Catalogue</a></li>
                    <li><a href="<?php echo $ld; ?>about/"><span class="glyphicon glyphicon-info-sign"></span> About LMS?</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right center-block" style="margin-right: 0; ">
                	<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
						<select name="format-field" class="form-control" value="all" style="color:#000;">
                            <option value="all">All Formats & Fields</option>
                            <optgroup label="Book Format">
                                <?php
                                    if(isset($conn)) {
                                        $booksFormatResult = mysqli_query($conn, $booksFormatQuery);

                                        while($booksFormat = mysqli_fetch_array($booksFormatResult)) {
                                            $booksFormatCode = $booksFormat['book_format_code'];
                                            $booksFormatMeaning = $booksFormat['book_format'];

                                            ?>
                                                <option value="<?php echo $booksFormatCode; ?>"><?php echo $booksFormatMeaning; ?></option>
                                            <?php
                                        }
                                    } else {
                                ?>
                                    <option value="SOFT">SOFT COPY</option>
                                    <option value="HARD">HARD COPY</option>
                                    <option value="BOTH">BOTH (Hard & Soft)</option>
                                <?php
                                }
                                ?>
                            </optgroup>
                            <optgroup label="Book Field">
                                <?php
                                    if(isset($conn)) {
                                        $fieldResult = mysqli_query($conn, $fieldQuery);
                                        
                                        while($field = mysqli_fetch_array($fieldResult)) {
                                            $fieldCode = $field['lms_field_code'];
                                            $fieldMeaning = $field['lms_field'];

                                            ?>
                                                <option value="<?php echo $fieldCode; ?>"><?php echo $fieldMeaning; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </optgroup>
						</select>
						<input name="searchterm" type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					</form>
                    <button id="S-UP" class="btn btn-info" style="margin: 0"><span class="glyphicon glyphicon-chevron-up"></span></button>
                    <script type="text/javascript">
                        $("#S-UP").click(function() {
                            $('body,html').animate({scrollTop: 0}, 300);
                        });
                    </script>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>