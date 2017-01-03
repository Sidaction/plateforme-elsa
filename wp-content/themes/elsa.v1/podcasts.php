            
            <link href="<?php echo $cnSite->templatelink; ?>/_css/jplayer.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/jquery.jplayer.min.js"></script>
			<script type="text/javascript">
            //<![CDATA[
            $(document).ready(function(){
            
                $(".podcast").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {
                            mp3:"http://plateforme-elsa.clairetnet.com/wp-content/uploads/2014/02/beatz-jan-5740_hifi.mp3",
                        });
                    },
                    swfPath: "<?php echo $cnSite->templatelink; ?>/_swf",
                    solution: "flash, html",
                    supplied: "mp3",
                    wmode: "window",
                    smoothPlayBar: true,
                    keyEnabled: true
                });
            });
            //]]>
            </script>
            
            <div class="podcast" class="jp-jplayer"></div>

            <div id="jp_container_1" class="jp-audio">
                <div class="jp-type-single">
                    <div class="jp-gui jp-interface">
                        <ul class="jp-controls">
                            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                            <!-- <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li> -->
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                        <div class="jp-time-holder">
                            <div class="jp-current-time"></div>
                            <div class="jp-duration"></div>
                        </div>
                    </div>
                    <div class="jp-no-solution">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>