var fb = {
  config :{
  // CONFIG VARS: 

    app_id : '148254541923045', 

    use_xfbml : true,

    extendPermissions : 'read_stream,user_status,publish_stream,email' , 
    // info: http://wiki.developers.facebook.com/index.php/Extended_permissions

    locale : 'es_ES' 
    // all locales in: http://www.facebook.com/translations/FacebookLocales.xml

  // END CONFIG VARS
  },
  perms : [],
  hasPerm : function (perm) { for(var i=0, l=fb.perms.length; i<l; i++) { if(fb.perms[i] == perm) {return true;}} return false; },
  logged : false,
  user : false, // when login, is a user object: http://developers.facebook.com/docs/reference/api/user
  login : function (callback){
    FB.login(function(r) {
      if (r.session) {
        fb.logged = true;
        if(r.perms)
          fb.perms = r.perms.split(",");
        else
          fb.perms = []; 
	fb.getUser(callback);
      } else {
        fb.logged = true;
        fb.perms = [];
	callback();
      }
    },{perms:fb.config.extendPermissions});
    return true;
  },
  syncLogin : function (callback){
    if (!callback) callback = function(){};
    FB.getLoginStatus(function(r) {
      if (r.session) { 
        fb.logged = true;
        if(r.perms)
          fb.perms = r.perms.split(",");
        else
          fb.perms = []; 
	fb.getUser(callback);
        return true;
      } else {
        fb.logged = false;
        callback();
        return false;
      }
    });
  },
  logout : function(callback) {FB.logout(callback);},
  getUser : function(callback){
    FB.api('/me', function(r){
      var user = r;
      user.picture = "https://graph.facebook.com/"+user.id+"/picture";
      fb.user=user; callback(user); 
    }); 
  },
  publish : function (publishObj,callback,noReTry) {
  // publishObj: http://developers.facebook.com/docs/reference/api/post   
    if (fb.logged && fb.hasPerm('publish_stream'))
    { 
      FB.api('/me/feed', 'post', publishObj, function(response) {
      if (!response || response.error) {
        callback(false);
      } else {
        callback(true);
      }
      });
      return true;
    }
    else
    { 
      if (!noReTry)
      	return fb.login(function() { return fb.publish(publishObj,callback,1)});
      else
      {
        callback(false);
        return false;
      }
    }
  },
  readyFuncs : [],
  ready: function(func){fb.readyFuncs.push(func)},
  launchReadyFuncs : function () {for(var i=0,l=fb.readyFuncs.length;i<l;i++){fb.readyFuncs[i]();};}
}
window.fbAsyncInit = function() { 
  if (fb.config.app_id) FB.init({appId: fb.config.app_id, status: true, cookie: true, xfbml: fb.config.use_xfbml});
  fb.syncLogin(fb.launchReadyFuncs);
};
var oldload = window.onload;
window.onload = function() {
  var d = document.createElement('div'); d.id="fb-root"; document.getElementsByTagName('body')[0].appendChild(d);
  var e = document.createElement('script'); e.async = true; e.src = document.location.protocol + '//connect.facebook.net/'+fb.config.locale+'/all.js';
  document.getElementById('fb-root').appendChild(e);
  if (typeof oldload == 'function') oldload();
};
