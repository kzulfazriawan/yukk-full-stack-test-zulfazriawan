const LoginController = ($scope, $window, $cookies, Http) => {
    $scope.form = {
        is_login: true,
        login: {
            email: null,
            password: null,
        },
        register: {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            agreement: false,
        }
    }

    $scope.success = {
        login: {
            alert: null,
            email: false,
            password: false,
        },
        register: {
            alert: null,
            name: false,
            email: false,
            password: false,
            password_confirmation: false,
            agreement: false,
        }
    }

    $scope.error = {
        login: {
            alert: null,
            email: null,
            password: null,
        },
        register: {
            alert: null,
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            agreement: null,
        }
    }

    $scope.toggle = () => {
        $scope.form.is_login = !$scope.form.is_login;
    }

    $scope.submit = () => {
        let target = ($scope.form.is_login) ? '/api/v1/login': '/api/v1/register';
        let data   = ($scope.form.is_login) ? $scope.form.login : $scope.form.register;

        Http.sendAsJson('POST', target, {data: data}).then(
            (response) => {
                console.log(response, 'success');
                let data = response.data;
                
                if($scope.form.is_login){
                    $scope.success.login.alert = 'Authentication Granted! Welcome to Application';
                    $cookies.put('token', data.token);

                    setTimeout(() => {
                        $window.location.href = '/';
                    }, 750);
                }
            },
            (response) => {
                let data = response.data;

                if($scope.form.is_login){
                    $scope.error.login.alert = data.message;

                    if(data.errors)
                        Object.keys(data.errors).forEach(i => { $scope.error.login[i] = data.errors[i][0] });
                }
            }
        )
    }
}

export {LoginController}