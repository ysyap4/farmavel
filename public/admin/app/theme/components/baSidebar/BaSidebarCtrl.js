/**
 * @author v.lugovksy
 * created on 16.12.2015
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.theme.components')
  .controller('BaSidebarCtrl', BaSidebarCtrl);

/** @ngInject */
function BaSidebarCtrl($scope, baSidebarService, $window, baConfig) {

    $scope.menuItems = baSidebarService.getMenuItems();
    $scope.menuItemsAccess = [];
    var jsonMenu = JSON.parse($window.sessionStorage.menus); // JSON from Service

    angular.forEach($scope.menuItems, function (baSideBarMenu) {
        angular.forEach(jsonMenu, function (accessMenu) {
            if (accessMenu.MenuName === baSideBarMenu.name) {
                $scope.menuItemsAccess.push(baSideBarMenu)
                return;
            }
        })
    })

    $scope.menuItems = $scope.menuItemsAccess;

    $scope.defaultSidebarState = $scope.menuItems[0].stateRef;

    $scope.hoverItem = function ($event) {
        $scope.showHoverElem = true;
        $scope.hoverElemHeight = $event.currentTarget.clientHeight;
        var menuTopValue = 60;
        $scope.hoverElemTop = $event.currentTarget.getBoundingClientRect().top - menuTopValue;
    };

    $scope.$on('$stateChangeSuccess', function () {
        if (baSidebarService.canSidebarBeHidden()) {
            baSidebarService.setMenuCollapsed(true);
        }
    });
}
})();