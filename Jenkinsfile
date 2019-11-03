pipeline {
  agent any
  stages {
    stage('--BUILD--'){
      steps {
        sh 'docker build -t shankh-server .'
      }
    }
    stage('--DEPLOY--') {
      steps { 
        sh 'whoami'
      }
    }
  }
}
