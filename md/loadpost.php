<?php
include "md-config.php";
include "functions.php";

$start=$_POST['start'];
$count=$_POST['count'];
$user_id=$_POST['user_id'];
$logged=$_POST['logged'];
$max=$start+$count-1;
$sql="select * from status where user_id=$user_id ORDER BY id desc limit $max,$start";
echo $sql;
$query=mysql_query($sql);
?>
<?php
  //$result=mysql_query($sql);
    while ($row =  mysql_fetch_array($query)):
      $datetime=$row['create_time'];
      $datetime=explode(" ",$datetime);
      $year= date("j F, Y", strtotime($datetime[0]));
      $hours= date("H:i", strtotime($datetime[1]));
?>
    <div class="status-box emoticons">
        <div class="content-status-box">
          <a href="<?php echo working_domain.'permarklink.php?post='. $row['id']; ?>"><p class="status-time"><?php echo $year. ' at '.$hours; ?></p></a>

          <p class="status-text-content"><?php echo $row['content'] ?></p>
          <div class="social-tool">
            <div class="social-share">
              <ul>
                  <li>
                    <a href="javascript:window.open('http://www.facebook.com/sharer.php?u=<?php echo working_domain.'permarklink.php?post='. $row['id']; ?>','Share','width=500,height=150')"><img src="<?php echo working_domain.'img/fb.png'?>" /></a>
                  </li>
                  <li>
                    <a href="javascript:window.open('https://plus.google.com/share?url=<?php echo working_domain.'permarklink.php?post='. $row['id']; ?>','Share','width=500,height=150')"><img src="<?php echo working_domain.'img/gg.png'?>" /></a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="comment-box" id="comment-box-<?php echo $row['id']; ?>">
          <div class="clear"></div>


          <?php
            $showCmt=false;
            $c=1;
            $resultCmt=getComment($row['id']);
            $numrowCmt=mysql_num_rows($resultCmt);
            if($numrowCmt>3) echo '<a href="#" id="view-more-commtents-'.$row['id'].'" class="view-more-commtents" onclick=viewmorcomment("'.$row['id'].'")>View more comments</a>';

            while ($rowCmt =  mysql_fetch_array($resultCmt)):

              $datecmnt=$rowCmt['create_time'];
              $datecmnt=explode(" ",$datecmnt);
              $yearcmt= date("j F, Y", strtotime($datecmnt[0]));
              $hourscmt= date("H:i", strtotime($datecmnt[1]));
              $b=$numrowCmt-3;
              if($c>$b)
                $showCmt=true;
            ?>

            <div class="comment <?php if($showCmt!=true) echo "hide-comment"; ?>    ">
              <p><span class="name"><?php echo $rowCmt['name'];?>:</span> <span class="comment-text"><?php echo $rowCmt['content'];?></span><span class="date-cmt"><?php echo $hourscmt.', '.$yearcmt; ?></span></p>
              <?php
                  if($rowCmt['image']!='')
                  {
                    echo '<img src="'.working_domain.'../upload_files/images/'.$rowCmt['image'].'"/>';
                  }
               ?>
            </div>
            <?php
            $c=$c+1;
            endwhile;
          ?>
          <div class="clear"></div>
        </div>
        <?php
          //if user logged than show comment box
          if($logged):
        ?>
        <div class="input-comment-box">
          <form  id="input-comment-form-<?php echo $row['id']; ?>">
            <div class="input-cmnt-wrap">
              <input name="input-comment" id="input-comment-<?php echo $row['id']; ?>" class="input-comment" />
              <div class="upload-cmt">
                <input type="file" name="img-cmnt" id="img-cmnt-<?php echo $row['id']; ?>" statusid="<?php echo $row['id']; ?>" accept="image/*" class="inputfile inputfile-5" data-multiple-caption="{count} files selected" />
                <label for="img-cmnt-<?php echo $row['id']; ?>"><img src="img/upload.png" /> <span></span></label>
              </div>
            </div>

            <a href="javascript:void(0)" class="send-comment-btn btn" onclick=sendComment("<?php echo $row['id']; ?>") > Send </a>
            <div class="clearfix"></div>
            <div class="filename">
              <p id="filename2-<?php echo $row['id']; ?>" class="filename2"></p>
            </div>
            <div class="spinner" id="spinner-<?php echo $row['id']; ?>">
              <div class="spinner__item1"></div>
              <div class="spinner__item2"></div>
              <div class="spinner__item3"></div>
              <div class="spinner__item4"></div>
            </div>
            <div class="clearfix"></div>
          </form>

        </div>

      <?php endif; ?>
    </div>
<?
    endwhile;
?>
