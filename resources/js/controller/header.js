import UIkit from "uikit";

const Header = function($scope, $rootScope, $window, Http){
    $scope.default = true;

    var current = null;

    $scope.menu = (name, target) => {
        ( target == 'default' ) ? ( $scope.default = ( name == current ) ? true : false ) : $scope.default = false;
        UIkit.switcher(".uk-switcher").show(name);
        current = name;
    }
}

export {Header}