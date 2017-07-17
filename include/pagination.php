<?php if($pagination_page == "index.php") { $pagination_page = ""; } ?>

<?php if($max_pgno == 1) { // NO PAGINATION
    } else if($max_pgno > 1) { ?>
    <div id="pagination" class="text-right">
        <ul class="pagination pagination-sm" style="margin: 0;">	
			<?php
				# Prevoius Pagination
				if($cur_pgno == 1) { 
                	echo "<li class='active disabled'><a href='javascript:void(0);'><strong>Prev</strong></a></li>";
                 } else { 
                 	$prev_pgno = $cur_pgno-1;
                	echo "<li class='active'><a href='$pagination_page?page=$prev_pgno' title='previous'><strong>Prev</strong></a></li>";
                 }


				if($max_pgno <= 10) {
                    for($pgno = 1; $pgno <= $max_pgno; $pgno++) { 
                        if($cur_pgno == $pgno) {
                            echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                        } else { 
                            echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                        }
                    }
                } else {

                	// 1st
                	if(1 == $cur_pgno) {
                        echo "<li class='active'><a href='$pagination_page?page=1'>1</a></li>";

                        for($pgno = 2; $pgno <= $cur_pgno+7; $pgno++) { 
                            if($cur_pgno == $pgno) {
                                echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                            } else { 
                                echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                            }
                        }

                        echo "<li><a href='javascript:void(0);' title='others'>...</a></li>"; 
                    } else { 
                        echo "<li><a href='$pagination_page?page=1'>1</a></li>";
                    }


                    	// Others (==2, ==3, ==2nd2dLast, ==3rd2dLast, between 3rd & 3rd2dLast)
                    	if($cur_pgno == 2) {
                        	for($pgno = $cur_pgno; $pgno <= $cur_pgno+6; $pgno++) { 
                                if($cur_pgno == $pgno) {
                                    echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                } else { 
                                    echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                }
                            }

                            echo "<li><a href='javascript:void(0);' title='others'>...</a></li>";
                            // 2nd
                        } else if($cur_pgno == 3) {
                        	for($pgno = $cur_pgno-1; $pgno <= $cur_pgno+5; $pgno++) { 
                                if($cur_pgno == $pgno) {
                                    echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                } else { 
                                    echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                }
                            }

                            echo "<li><a href='javascript:void(0);' title='others'>...</a></li>";
                            // 3rd
                        } else if($cur_pgno == $max_pgno-1) {
                    		echo "<li><a href='javascript:void(0);' title='others'>...</a></li>";

                        	for($pgno = $cur_pgno-6; $pgno <= $cur_pgno; $pgno++) { 
                                if($cur_pgno == $pgno) {
                                    echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                } else { 
                                    echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                }
                            }
                            // 2nd to the Last
                        } else if($cur_pgno == $max_pgno-2) {
                    		echo "<li><a href='javascript:void(0);' title='others'>...</a></li>";

                        	for($pgno = $cur_pgno-5; $pgno <= $cur_pgno+1; $pgno++) { 
                                if($cur_pgno == $pgno) {
                                    echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                }else { 
                                    echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                }
                            }
                            // 3rd to the Last
                        } else if($cur_pgno > 3 && $cur_pgno < $max_pgno-2) {
                        	echo "<li><a href='javascript:void(0);' title='others'>...</a></li>";

                        	for($pgno = $cur_pgno-2; $pgno <= $cur_pgno+2; $pgno++) { 
                                if($cur_pgno == $pgno) {
                                    echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                } else { 
                                    echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                                }
                            }

                        	echo "<li><a href='javascript:void(0);' title='others'>...</a></li>";
                        } else {
                        	// Do Nothing || Add Nothing
                        }
                        // Others (if($cur_pgno > 3 && $cur_pgno < $max_pgno-2))


                    # Last
                    if($max_pgno == $cur_pgno) {
                    	echo "<li><a href='javascript:void(0);' title='others'>...</a></li>";

                    	for($pgno = $max_pgno-7; $pgno <= $max_pgno-1; $pgno++) { 
                            if($cur_pgno == $pgno) {
                                echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                            } else { 
                                echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
                            }
                        }

                        echo "<li class='active'><a href='$pagination_page?page=$max_pgno'>$max_pgno</a></li>";
                    } else { 
                        echo "<li><a href='$pagination_page?page=$max_pgno'>$max_pgno</a></li>";
                    }
                }
                // else max pages > 5 ends here!

                # Next Pagination
                if($cur_pgno == $max_pgno) { 
                	echo "<li class='active disabled'><a href='javascript:void(0);'><strong>Next</strong></a></li>";
                 } else { 
                	$next_pgno = $cur_pgno+1;
                	echo "<li class='active'><a href='$pagination_page?page=$next_pgno' title='next'><strong>Next</strong></a></li>";
                 }
            ?>
        </ul>
    </div>
<?php } else { ?>
        <p class="bg-warning text-center text-danger" style="font-size: 48px; margin: 88px 0px;"><strong>Nothing Found!</strong></p>
<?php } ?>
<!--else if($cur_pgno == $max_pgno-1) {
	echo "<li><a href='javascript:void(0);' title='others'>...</a></li>";

	for($pgno = 10+(ceil($max_pgno/$cur_pgno)); $pgno <= $cur_pgno+($max_pgno-$cur_pgno-1); $pgno++) { 
        if($cur_pgno == $pgno) {
            echo "<li class='active'><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
        } else { 
            echo "<li><a href='$pagination_page?page=$pgno'>$pgno</a></li>";
        }
    }
    // 2nd to the Last
}-->