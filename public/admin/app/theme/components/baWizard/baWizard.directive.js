(function() {
  'use strict';

  angular.module('BlurAdmin.theme.components')
    .directive('baWizard', baWizard);

  /** @ngInject */
  function baWizard() {
    return {
      restrict: 'E',
      transclude: true,
      templateUrl: adminPath + '/app/theme/components/baWizard/baWizard.html',
      controllerAs: '$baWizardController',
      controller: 'baWizardCtrl'
    }
  }
})();
