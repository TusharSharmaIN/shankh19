pipeline {
  agent any
  stages {
    stage('--BUILD--'){
      steps {
        sh 'BUILD COMPLETE'
      }
    }
    stage('--DEPLOY--') {
      steps { 
        sh 'docker cp . shankhnaad.org:/var/www/shankhnaad.org/public_html/'
      }
    }
  }
}
