<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>HTML5-Testsite</title>
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="copyright" content="<?php echo $meta_copywrite; ?>" />
        <?php foreach ($styles as $file => $type){echo HTML::style($file, array('media' => $type)), "\n";} ?>
        <?php foreach ($scripts as $file){echo HTML::script($file, NULL, TRUE), "\n";} ?>
    </head>
  <!--[if lt IE 7 ]><body class="no-js ie6"><![endif]-->
  <!--[if IE 7 ]><body class="no-js ie7"><![endif]-->
  <!--[if IE 8 ]><body class="no-js ie8"><![endif]-->
  <!--[if (gte IE 9)|!(IE)]><!--> <body class=no-js> <!--<![endif]-->
        <div id="wrapper">
            <header id="header">
                <h1>Ilch CMS 2.0</h1>
                <nav>
                    <ul>
                        <li><a href="#">Site 1</a></li>
                        <li><a href="#">Site 2</a></li>
                        <li><a href="#">Site 3</a></li>
                        <li><a href="#">Site 4</a></li>
                        <li><a href="#">Site 5</a></li>
                    </ul>
                </nav>
            </header>
            <div id="content"><!--
            <section id="news">
                <article>
                    <header>
                        <h2>
                            First News
                            <time datetime="2009-11-13T20:00+01:00" pubdate>8:00 pm</time>
                        </h2>
                    </header>
                    <p>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                    </p>
                    <footer>
                        <a href="#">read more</a>
                    </footer>
                </article>
                <article>
                    <header>
                        <h2>First News <time datetime="2009-11-13T20:00+01:00" pubdate>8:00 pm</time></h2>
                    </header>
                    <p>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                    </p>
                    <footer>
                        <a href="#">read more</a>
                    </footer>
                </article>
                <article class="last">
                    <header>
                        <h2>First News <time datetime="2009-11-13T20:00+01:00" pubdate>8:00 pm</time></h2>
                    </header>
                    <p>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                    </p>
                    <footer>
                        <a href="#">read more</a>
                    </footer>
                </article>
            </section>-->
            <section><!--
                <article>
                    <header>
                        <h2>Come to my birthday party on <time datetime="2010-03-01">1 March</time></h2>
                        <p>Published on <time datetime="2010-01-20" pubdate>20 January 2010</time></p>
                    </header>
                    <p>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                    </p>
                    <p>
                        <video id="video" src="http://cdn.kaltura.org/apis/html5lib/kplayer-examples/media/bbb400p.ogv" controls="" poster="http://cdn.kaltura.org/apis/html5lib/kplayer-examples/media/bbb480.jpg"></video>
                    <p>
                        Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                    </p>
                    <footer>
                        <a href="#">comments (6)</a>
                    </footer>
                </article>
                <article>
                    <header>
                        <h2>Welcome to my blog</h2>
                        <p>Published on <time datetime="2010-01-19" pubdate>19 January 2010</time></p>
                    </header>
                    <p>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                    </p>
                    <p>
                        <audio id="audio" src="http://www.vorbis.com/music/Epoq-Lepidoptera.ogg" controls=""></audio>
                    </p>
                    <p>
                        Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                    </p>
                    <footer>
                        <a href="#">comments (34)</a>
                    </footer>
                </article>-->
                <article>
                    <?php echo $content; ?>
                </article>
            </section>
            </div>
            <aside id="sidebar">
                <h3>Installierte SVN-DB</h3>
                <?php echo Widget_Svn::action_index(); ?>
                
                <!--<h3>Best joke</h3>
                <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                </p>
                <h3>My Address</h3>
                <address>
                    Dr. McMuffin<br />
                    Muffin Road 89/4<br />
                    Duggonini
                </address>-->
            </aside>
            <footer id="footer">
                <small>&copy 2011 by Team ScreenDesigner</small>
            </footer>
        </div>
    </body>
</html>
