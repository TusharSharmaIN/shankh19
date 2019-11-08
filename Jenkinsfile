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
        sh 'chmod u+x Jenkins.sh'
        sh './Jenkins.sh'
      }
    }
  }
}