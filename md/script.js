$( document ).ready(function() {

  //notify


//notify friend click
  $(".notificationLink_friend").click(function()
  {

      $(".notificationContainer").hide();
      $(".notificationContainer_friend").fadeToggle(300);
      $(".notification_count_friend").fadeOut("slow");
        $('#spinner-notificationContainer_friend').show();
    //  if($(this).attr("done")!="true"){
      //  $(this).attr("done","true");
        loadNotifcation(1);
      //}
    return false;
  });


  //notify message click
  $(".notificationLink_message").click(function()
  {
    $(".notificationContainer").hide();
    $(".notificationContainer_message").fadeToggle(300);
    $(".notification_count_message").fadeOut("slow");
    $('#spinner-notificationContainer_message').show();
      loadNotifcation(2);
    return false;
  });

//notify notifi click
  $(".notificationLink_notification").click(function()
  {
    $(".notificationContainer").hide();
    $(".notificationContainer_notification").fadeToggle(300);
    $(".notification_count_notification").fadeOut("slow");
    $('#spinner-notificationContainer_notification').show();
      loadNotifcation(3);
    return false;
  });

  function loadNotifcation(type){
    $.post("functions.php",
      {
          getFriendRequest1: "yes",
          type: type,
          user_id: $("#userloggedid").val()
      },
      function(data, status){
        //console.log(data);
        switch (type) {
          case 1:
              $('.notificationContainer_friend .notificationsBody').empty();
              $('.notificationContainer_friend .notificationsBody').append(data);
              $('#spinner-notificationContainer_friend').hide();
             break;
          case 2:
            $('.notificationContainer_message .notificationsBody').empty();
            $('.notificationContainer_message .notificationsBody').append(data);
            $('#spinner-notificationContainer_message').hide();

            break;
          case 3:
            $('.notificationContainer_notification .notificationsBody').empty() ;
            $('.notificationContainer_notification .notificationsBody').append(data);
            $('#spinner-notificationContainer_notification').hide();

             break;
          default:

        }

      });
  }

  $(document).on("click",".like",function()
  {

    var statusid=$(this).attr("status-id");
    $.post("functions.php",
      {
        like1: "yes",
        userloggedid: $("#userloggedid").val(),
        status_id:statusid
      },
      function(data, status){
        console.log(data+"," +status);
        $("#like-"+statusid).text(data);

    });
    return false;
  });
  //Document Click
  $(document).click(function()
  {
    $(".notificationContainer").hide();
  });


//click addfriend button
  $(".addfriend-btn").click(function (event){
    event.preventDefault();
    var friendid=$("#user_id").val();
    var user_logged_id=$("#user_logged_id").val();
    $(this).val("Adding");

    $.post("functions.php",
      {
          addfriend1: "yes",
          friendid: $("#user_id").val(),
          userloggedid:$("#userloggedid").val(),

      },
      function(data, status){
        $(".addfriend-btn").val("Friend request send");
        //  console.log(data);
            location.reload();
      });
  });


  //click addfriend button
    $(".unfriend-btn").click(function (event){
      event.preventDefault();
      var friendid=$("#user_id").val();
      var user_logged_id=$("#user_logged_id").val();
      $(this).val("...");

      $.post("functions.php",
        {
            unfriend1: "yes",
            friendid: $("#user_id").val(),
            userloggedid:$("#userloggedid").val(),

        },
        function(data, status){
          location.reload();

          //console.log(data);
        });
    });
  $(function(){

     $(".accept-add-friend-request").on('click',function() {
         $(this).hide();
        // $("#hidden-div").show();
     });
  });
  //	$(".emoticons").emotions();
});


function updateStatusNotif(notif_id){
  $("li-"+notif_id+" a").removeClass("notif-status-1");
  $.post("functions.php",
  {
     updateStatusNotif1: "yes",
     notif_id:notif_id
  },
   function(data, status){

  });
}

function acceptRequest(userRequest,notif_id){
  $.post("functions.php",
  {
    acceptFriendRequest1: "yes",
    userRecieve:$("#userloggedid").val(),
    userRequest:userRequest,
    notif_id:notif_id
  },
  function(data, status){
      $(".li"+notif_id).hide();

  });
}

function rejectRequest(userRequest,notif_id){
   $.post("functions.php",
  {
    rejectFriendRequest1: "yes",
    userRecieve:$("#userloggedid").val(),
    userRequest:userRequest,
    notif_id:notif_id
  },
  function(data, status){
    //console.log(status);
  });
}

function viewmorcomment (status_id){
  event.preventDefault();
  $("#comment-box-"+status_id+" .comment").removeClass("hide-comment");
  $("#view-more-commtents-"+status_id).hide();
}


  //post status
  $( "#post-status-form" ).submit(function( event ) {

      alert("sdf");
      event.preventDefault();
      var formData = new FormData($("#post-status-form")[0]);
      var file = $('#file_234x')[0].files[0];
      if(file){
          $.ajax({
            type: "POST",
            url: "uploadcmt.php",
            data: formData,
            contentType: false,
            processData: false,
            async: true,
            enctype: 'multipart/form-data',
            success:function(data){
                var obj = $.parseJSON(data);
              //  console.log(obj);
                if(obj.return=="1"){
                  filename=obj.mess;
                  PostStatus(filename);
                }
                else {
                  $("#filename2-234x").text(obj.mess);
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                  $("#filename2-234x").text("Fail to upload.");

            },
          });
      }

  });

  function PostStatus(filename){
    $.post("functions.php",
      {
          postStatus1: "yes",
          file_name:filename,
          user_id: $("#user_id").val(),
          content:$("#input-status-content").val()
      },
      function(data, status){
          //alert("Data: " + data + "\nStatus: " + status);
        //  $("#spinner-"+status_id).hide();
      //    console.log(data);
      /*    if(data!=false){
            $("#input-comment-"+status_id).val("");
            $("#comment-box-"+status_id).append(data)
          }\
          */
      });

  }

function sendComment (status_id){

  $("#spinner-"+status_id).show();

    var filename="";
    var formData = new FormData($("#input-comment-form-"+status_id)[0]);
    var file = $('#img-cmnt-'+status_id)[0].files[0];
    if(file){
        $.ajax({
          type: "POST",
          url: "uploadcmt.php",
          data: formData,
          contentType: false,
          processData: false,
          async: true,
          enctype: 'multipart/form-data',
          success:function(data){
              var obj = $.parseJSON(data);
              if(obj.return=="1"){
                filename=obj.mess;
                PostComment(status_id,filename);
              }
              else {
                $("#filename2-"+status_id).text(obj.mess);
              }
          },
          error:function (xhr, ajaxOptions, thrownError){
                $("#filename2-"+status_id).text("Fail to upload.");

          },
        });


    }else{
      PostComment(status_id,"");
    }

  $("#filename2-"+status_id).text("");


}
function PostComment(status_id,filename){
  $.post("functions.php",
    {
        postcomment1: "yes",
        user_id: $("#user_id").val(),
        file_name:filename,
        userloggedid:$("#userloggedid").val(),
        userloggedname:$("#userloggedname").val(),
        statusid:status_id,
        content: $("#input-comment-"+status_id).val()
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
        $("#spinner-"+status_id).hide();
      //  console.log(data);
        if(data!=false){
          $("#input-comment-"+status_id).val("");
          $("#comment-box-"+status_id).append(data)
        }
    });

}

  count=3;
  start=3;
  loading="false";
  $(window).scroll(function(){
    if(loading=="false"){

      a=$( document ).height()-$(window).height();
      b=Math.round($(window).scrollTop());
      c=Math.round($(window).scrollTop());
      if(a==b || a==c){
        loading="true";
         $(".loadimg").show();
        if($("#indexpage").val()=="true")
          $.post('loadpost.php',
            {
              user_id:$("#user_id").val(),
              logged:$("#userlogged").val(),
              start:start,
              count:count

            }, function(data){
              $('.time-line').append(data);
                start=start+count;
                loading="false";
            //  alert(start);
             $(".loadimg").hide();
            }
          )
      }
    }
  });
