// (function (Drupal) {
//   Drupal.behaviors.customBundleBehavior = {
//     attach: function (context, settings) {
//       console.log('JavaScript for a specific content type or node is loaded!');
      
//       // Add your custom JS logic here
//       document.querySelectorAll('body').forEach(function (element) {
//         element.style.backgroundColor = 'green';
//       });
//     }
//   };
// })(Drupal);

(function ($,Drupal) {
  Drupal.behaviors.customBundleBehavior = {
    attach: function (context, settings) {
      console.log('JavaScript for a specific content type or node is loaded!');

      // Change the background color of the body
      $(".region").css("background-color", "green")
      // document.body.style.backgroundColor = 'lightblue';  
    }
  };
})(jQuery,Drupal);