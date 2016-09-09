app = angular.module('app',    [
        'ui.bootstrap',
    ]);

app.controller('SignUpController', function($scope, $http) {
     function initData() {

        $scope.user = {};
        $scope.dateOptions = {
            dateDisabled: disabled,
            formatYear: 'yy',
            maxDate: new Date(2020, 5, 22),
            startingDay: 1
        };

        $http.get('/location')
            .then(function(response) {
                $scope.countrylist = response.data.countrylist;
                $scope.user.national_id = $scope.countrylist[0].id;
                $scope.user.country_id = $scope.countrylist[0].id;

                $scope.onSelectCountry($scope.user.country_id);
            }).catch(function(response) {
            })
            .finally(function() {
            });
    }

    initData();

    $scope.onSelectCountry = function(country_id) {
        $http.get('/city/' + country_id)
            .then(function(response) {
                $scope.citylist = response.data.citylist;
                $scope.user.city_id = $scope.citylist[0].id;
             }).catch(function(response) {
            })
            .finally(function() {
            });
    }

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
