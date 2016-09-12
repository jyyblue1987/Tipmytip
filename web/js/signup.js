app = angular.module('app',    [
        'ui.bootstrap', 'toaster', 'ngOpenFB',
    ]);

app.controller('SignUpController', function($scope, $http, ngFB, toaster) {
     function initData() {
         ngFB.init({appId: '1165809443511301'});
         //ngFB.init({appId: '619623278194684'});

        $scope.user = {};
         $scope.user.gender = "Male";
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
                $scope.user.country_id1 = $scope.countrylist[0].id;
                $scope.user.country_id2 = $scope.countrylist[0].id;
                $scope.user.country_id3 = $scope.countrylist[0].id;
                $scope.user.country_id4 = $scope.countrylist[0].id;


                $scope.onSelectCountry($scope.user.country_id, 0);
                $scope.onSelectCountry($scope.user.country_id, 1);
                $scope.onSelectCountry($scope.user.country_id, 2);
                $scope.onSelectCountry($scope.user.country_id, 3);
                $scope.onSelectCountry($scope.user.country_id, 4);
            }).catch(function(response) {
            })
            .finally(function() {
            });
    }

    initData();

    $scope.onSelectCountry = function(country_id, num) {
        $http.get('/city/' + country_id)
            .then(function(response) {
                switch (num) {
                    case 0:
                        $scope.citylist0 = response.data.citylist;
                        $scope.user.city_id = $scope.citylist0[0].id;
                        break;
                    case 1:
                        $scope.citylist1 = response.data.citylist;
                        $scope.user.city_id1 = $scope.citylist1[0].id;
                        break;
                    case 2:
                        $scope.citylist2 = response.data.citylist;
                        $scope.user.city_id2 = $scope.citylist2[0].id;
                        break;
                    case 3:
                        $scope.citylist3 = response.data.citylist;
                        $scope.user.city_id3 = $scope.citylist3[0].id;
                        break;
                    case 4:
                        $scope.citylist4 = response.data.citylist;
                        $scope.user.city_id4 = $scope.citylist4[0].id;
                        break;
                }

             }).catch(function(response) {
            })
            .finally(function() {
            });
    }

    $scope.open = function() {
        $scope.opened = true;
    };

    $scope.signupFacebook = function() {
        ngFB.login({scope: 'email,public_profile,publish_actions'}).then(
            function(response) {
                console.log(response.authResponse);
                getFacebookProfile();
            },
            function(response, status) {

            });
    }

    function getFacebookProfile(){
        ngFB.api({path: '/me',params: {fields: 'id,name,email,first_name,last_name,gender'}}).then(
            function(user) {
                $scope.user = user;
                if( user.gender = 'male')
                    $scope.user.gender = 'Male';
                else if( user.gender = 'female')
                    $scope.user.gender = 'Female';
                $scope.confirm_email = user.email;
            }
        );
    }
    // Disable weekend selection
    function disabled(data) {
        var date = data.date,
            mode = data.mode;

        var today = new Date();

        return mode === 'day' && (date > today);
        //return false;
    }

    function getObjectFromArray(objarray, key, value) {
        var ret = {};
        ret.key = '';
        for(var i = 0; i < objarray.length; i++)
        {
            if( objarray[i][key] == value )
            {
                ret = objarray[i];
                break;
            }
        }

        return ret;
    }


    $scope.submit = function() {
        console.log($scope.user);

        var request = angular.copy($scope.user);

        if( request.email != $scope.confirm_email )
        {
            toaster.pop('error', 'Validation Error', 'Email does not match');
            return;
        }

        if( request.password != $scope.confirm_password )
        {
            toaster.pop('error', 'Validation Error', 'Password does not match');
            return;
        }

        request.date_of_birth = moment(request.date_of_birth).format('DD/MM/YYYY');
        if( request.gender == 'Other' && request.custom_gender)
            request.gender = request.custom_gender;


        request.country = getObjectFromArray($scope.countrylist, 'id', request.country_id).name;
        request.national = getObjectFromArray($scope.countrylist, 'id', request.national_id).name;

        $http({
            method: 'POST',
            url: '/createaccount',
            data: request,
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        })
            .then(function(response) {
                var data = response.data;
                if( data.code == 200 )
                    toaster.pop('success', 'Sign up Page', data.message);
                else
                    toaster.pop('error', 'Sign up Page', data.message);
                console.log(response.data);
            }).catch(function(response) {
                toaster.pop('error', 'Sign up Page', 'Account is fail to create');
                console.error('Gists error', response.status, response.data);
            })
            .finally(function() {
                $scope.isLoading = false;
            });
    }

});
