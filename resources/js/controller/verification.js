const VerificationController = ($scope, $location, $window, Http) => {
    $scope.is_verified      = false;
    $scope.verified_success = false;
    $scope.verified_errors  = false;
    $scope.url = null;

    let postVerification = (target, data) => {
        Http.sendAsJson('POST', target, {'data': data}).then(
            (response) => {
                $scope.verified_success = true;
                setTimeout(() => {
                    $window.location.href = '/auth'
                }, 3000);
            },
            (response) => {
                $scope.verified_errors = true;
            }
        );
    }

    $scope.init = () => {
        let q = $location.search();
        if(typeof q.token !== 'undefined' && typeof q.email !== 'undefined'){
            $scope.is_verified = true;
            postVerification(
                '/api/v1/verification',
                {token: q.token, email: q.email}
            );
        }

        if(typeof q.param_ !== 'undefined'){
            $scope.is_verified = false;
            let query  = atob(q.param_).split("|");
            $scope.url = '/verification?token=' + query[0] + '&email=' + query[1];
        }
    }
}

export {VerificationController};