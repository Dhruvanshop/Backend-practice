(function (Drupal) {
  Drupal.behaviors.globalBehavior = {
    attach: function (context, settings) {
      console.log('Sitewide JavaScript is working!');

      // Change the color of all text elements to purple
      document.querySelectorAll('body *').forEach(function (element) {
        element.style.color = 'purple';
      });
    }
  };
})(Drupal);
