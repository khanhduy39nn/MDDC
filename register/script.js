var url_connect="http://milliondollardesiclub.com/connect";
function openSocialPopup(provider,url_red)
{
  var url="";
  switch (provider) {
    case 1:
      url=url_connect+"/openid/?serviceid=1&login&url="+url_red;
      break;
    case 2:
      url=url_connect+"/openid/?serviceid=2&login=1&url="+url_red;
    break;
    case 3:
      url=url_connect+"/openid/?serviceid=3&login=1&url="+url_red;
      break;
    case 5:
      url=url_connect+"/openid/?serviceid=5&login=1&url="+url_red;
      break;
    default:   url=url_connect+"/openid/?serviceid=4";
    break;
  }
  window.open(url,'Get my contact','width=700,height=550');
}
