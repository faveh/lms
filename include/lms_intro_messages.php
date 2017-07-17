                    <h2 id="txt">FEEL FREE TO READ & DOWNLOAD SOFT COPY BOOKS FROM OUR LIBRARY!</h2>

                        <nav>
                            <a id="l-txt" class="glyphicon glyphicon-circle-arrow-left text-warning txt-control"></a>
                            <a id="r-txt" class="glyphicon glyphicon-circle-arrow-right text-warning txt-control"></a>
                        </nav>
                        
                        <script type="text/javascript">
                        var text = "";
                        var text1 = "INTRO SENTENCE 1";
                        var text2 = "INTRO SENTENCE 2";
                        var text3 = "INTRO SENTENCE 3";
                        var txt = [text1, text2, text3];

                            $("#l-txt").click(function() {
                                text = $("#txt").text();

                                if(text == text1) {
                                    $("#txt").text(text3);
                                } else if(text == text2) {
                                    $("#txt").text(text1);
                                } else {
                                    $("#txt").text(text2);
                                }
                            });
                            $("#r-txt").click(function() {
                                text = $("#txt").text();

                                if(text == text1) {
                                    $("#txt").text(text2);
                                } else if(text == text2) {
                                    $("#txt").text(text3);
                                } else {
                                    $("#txt").text(text1);
                                }
                            });
                        </script>