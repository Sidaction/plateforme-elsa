tarteaucitron.init({
    "privacyUrl": "", /* Privacy policy url */

    "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
    "cookieName": "tarteaucitron", /* Cookie name */

    "orientation": "bottom", /* Banner position (top - bottom - middle - popup) */

    "groupServices": true, /* Group services by category */

    "showAlertSmall": false, /* Show the small banner on bottom right */
    "cookieslist": false, /* Show the cookie list */
    
    "showIcon": false, /* Show cookie icon to manage cookies */
    // "iconSrc": "", /* Optionnal: URL or base64 encoded image */
    "iconPosition": "BottomRight", /* Position of the icon between BottomRight, BottomLeft, TopRight and TopLeft */

    "adblocker": false, /* Show a Warning if an adblocker is detected */

    "DenyAllCta" : true, /* Show the deny all button */
    "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
    "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */

    "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

    "removeCredit": true, /* Remove credit link */
    "moreInfoLink": true, /* Show more info link */
    "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */

    //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for subdomain website */

    "readmoreLink": "", /* Change the default readmore link pointing to tarteaucitron.io */
    
    "mandatory": true /* Show a message about mandatory cookies */
});


tarteaucitron.services.sendinblue = {
  "key": "sendinblue",
  "type": "api",
  "name": "SendInBlue",
  "needConsent": true,
  "cookies": ['PHPSESSID'],
  "readmoreLink": "https://fr.sendinblue.com/legal/cookies/", // If you want to change readmore link
  "js": function () {
    "use strict";
    // When user allow cookie
  },
  "fallback": function () {
    "use strict";
    // when use deny cookie
  }
};


tarteaucitron.user.gajsUa = 'UA-43730500-1';
tarteaucitron.user.gajsMore = function () { /* add here your optionnal _ga.push() */ };
(tarteaucitron.job = tarteaucitron.job || []).push('gajs');
(tarteaucitron.job = tarteaucitron.job || []).push('youtube');
(tarteaucitron.job = tarteaucitron.job || []).push('facebook');
(tarteaucitron.job = tarteaucitron.job || []).push('twitter');
(tarteaucitron.job = tarteaucitron.job || []).push('sendinblue');