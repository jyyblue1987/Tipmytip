app = angular.module('app',    [
        'ui.bootstrap',
    ]);

app.controller('SignUpController', function($scope, $http) {
    $scope.dateOptions = {
        dateDisabled: disabled,
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        startingDay: 1
    };

    $scope.open = function() {
        $scope.opened = true;
    };

    // Disable weekend selection
    function disabled(data) {
        //var date = data.date,
        //    mode = data.mode;
        //return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
        return false;
    }
});
