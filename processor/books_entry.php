<!DOCTYPE html>
<html>
<head>
    <title>Admin - Books Entry</title>

    <style type="text/css">
        body {
          font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
          font-size: 15px;
          line-height: 1.42857143;
          color: #ebebeb;
          background-color: #2b3e50;
        }
    </style>
</head>
<body>

</body>
</html>

<?php
session_start();

require_once "../include/connection.php";
require_once "../include/functions.php";
require_once "../include/config.php";

$refering_url = "../admin/books/";

if (!adminLoggedin($conn)) {
    header ("Location: $refering_url");
} else {
    $admin_id = $_SESSION['admin_id'];
    //$username = $_SESSION['admin_username'];

    if( isset($_POST['bea']) ) {
        $bea = $_POST['bea'];
        //$cur_amount = $_POST['cur_amount'];
        //$cur_amount = 0;

        for($i=1; $i<=$bea; $i++) {

          if($bea == 1) { ?>
            <div class="col-md-12 bk-entry">
             <h4 class="lbl danger bk-entry">Book Entry 1</h4>
          <?php
          } else { ?>
            <div class="col-md-6 bk-entry">
            <h4 class="lbl danger bk-entry">Book Entry <?php echo $i; ?></h4>
          <?php } ?>

                <div class="col-sm-2"><label>Title</label></div>
                <div class="col-sm-10"><input type="text" class="form-control entry<?php echo $i; ?>" name="title<?php echo $i; ?>"  /></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Author</label></div>
                <div class="col-sm-10"><input type="text" class="form-control entry<?php echo $i; ?>" name="author<?php echo $i; ?>" /></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Year</label></div>
                <div class="col-sm-10"><input type="text" class="form-control entry<?php echo $i; ?>" name="year<?php echo $i; ?>" /></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Field</label></div>
                <div class="col-sm-10"><select class="form-control entry<?php echo $i; ?>" name="field<?php echo $i; ?>">
                    <?php
                        $fieldResult = mysqli_query($conn, $fieldQuery);
                        while($field = mysqli_fetch_array($fieldResult)) {
                            $fieldCode = $field['lms_field_code'];
                            $fieldMeaning = $field['lms_field'];

                            ?>
                                <option value="<?php echo $fieldCode; ?>"><?php echo $fieldMeaning; ?></option>
                            <?php
                        }
                    ?>
                </select></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Publisher</label></div>
                <div class="col-sm-10"><input type="text" class="form-control entry<?php echo $i; ?>" name="publisher<?php echo $i; ?>" /></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Series Title</label></div>
                <div class="col-sm-10"><input type="text" class="form-control entry<?php echo $i; ?>" name="series_title<?php echo $i; ?>" /></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>ISBN</label></div>
                <div class="col-sm-10"><input type="text" class="form-control entry<?php echo $i; ?>" name="ISBN<?php echo $i; ?>" maxlength="20" /></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Volume</label></div>
                <div class="col-sm-10"><input type="number" class="form-control entry<?php echo $i; ?>" name="volume<?php echo $i; ?>" min="1" /></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Edition</label></div>
                <div class="col-sm-10"><input type="number" class="form-control entry<?php echo $i; ?>" name="edition<?php echo $i; ?>" min="1" /></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Format</label></div>
                <div class="col-sm-10"><select class="form-control entry<?php echo $i; ?>" name="format<?php echo $i; ?>">
                    <?php
                        $booksFormatResult = mysqli_query($conn, $booksFormatQuery);
                        while($booksFormat = mysqli_fetch_array($booksFormatResult)) {
                            $booksFormatCode = $booksFormat['book_format_code'];
                            $booksFormatMeaning = $booksFormat['book_format'];

                            ?>
                                <option value="<?php echo $booksFormatCode; ?>"><?php echo $booksFormatMeaning; ?></option>
                            <?php
                        }
                    ?>
                </select></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Type</label></div>
                <div class="col-sm-10"><select class="form-control entry<?php echo $i; ?>" name="type<?php echo $i; ?>">
                    <?php
                        $booksTypeResult = mysqli_query($conn, $booksTypeQuery);
                        $bkSet = 0;
                        $avSet = 0;
                        while($booksType = mysqli_fetch_array($booksTypeResult)) {
                            $booksTypeId = $booksType['book_type_id'];
                            $booksTypeCode = $booksType['book_type_code'];
                            $booksTypeMeaning = $booksType['book_type'];

                            if($booksTypeId <= 10) {
                                if($bkSet == 0) { echo "<optgroup label='Books'>"; }
                            ?>
                                <option value="<?php echo $booksTypeCode; ?>"><?php echo $booksTypeMeaning; ?></option>
                            <?php
                                if($bkSet == 0) { echo "</optgroup>"; }
                                $bkSet++;
                            } else {
                                if($avSet == 0) { echo "<optgroup label='Audio Visuals'>"; }
                                ?>
                                    <option value="<?php echo $booksTypeCode; ?>"><?php echo $booksTypeMeaning; ?></option>
                                <?php
                                if($avSet == 0) { echo "</optgroup>"; }
                                $avSet++;
                            }
                        }
                    ?>
                </select></div>
                <div class="clearfix"></div>
                <div class="col-sm-2"><label>Copies</label></div>
                <div class="col-sm-10"><input type="number" class="form-control entry<?php echo $i; ?>" name="copies<?php echo $i; ?>" min="1" /></div>
                
                <div class="clearfix"></div>
                <br>

                <center>
                    <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-danger reset<?php echo $i; ?>"><span class="glyphicon glyphicon-refresh"></span> RESET</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span> ADD</button>
                    </div>
                    <script type="text/javascript">
                        $(".reset<?php echo $i; ?>").click(function() {
                            $('.form-control.entry<?php echo $i; ?>').prop('value','');
                        });
                    </script>
                </center>
                <br>

            </div>
            <?php
        }
        
    } else { header ("Location: $refering_url"); }

}

?>