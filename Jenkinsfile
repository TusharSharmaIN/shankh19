pipeline {
  agent any
  stages {
    stage('--BUILD--'){
      steps {
        sh 'echo "BUILD COMPLETE"' 
      }
    }
    stage('--DEPLOY--') {
      steps { 
        sh 'docker cp . admin.shankhnaad.org:/var/www/admin.shankhnaad.org/public_html/'
      }
    }
  }
}