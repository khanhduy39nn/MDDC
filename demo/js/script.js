var base_url="http://milliondollardesiclub.com/connect";
function openSocialPopup(provider)
{
  var url="";
  switch (provider) {
    case 1:
      url=base_url+"/openid/?serviceid=1";
      break;
    case 2:
      url=base_url+"/openid/?serviceid=2";
    break;
    case 3:
      url=base_url+"/openid/?serviceid=3";
    break;
    default:   url=base_url+"/openid/?serviceid=4";
    break;
  }
  window.open(url,'Get my contact','width=700,height=550');
}
function redirectToPopupFacebookLogin(){
      window.location.assign(base_url+"/openid/?serviceid=");
}
function redirectToSelectFriendsPage(step,data){
  if(data!=""){
      window.location.assign(base_url+"/?step="+step+"&data="+data);
  }
  else{
    alert("de mama");
  }
}
function countsend()
{
  var send= $("count").text();
  alert(send);
  $("#count").text(send+1);
}
$( document ).ready(function() {


  $('#checkAll').on('click', function () {
      var checked = !$(this).data('checked');

      $('.chkaction').prop('checked', checked);

      $(this).data('checked', checked);
  });
});
