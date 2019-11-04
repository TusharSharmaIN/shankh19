pipeline {
  agent any
  stages {
    stage('myStage'){
      steps {
        sh 'docker ps' 
      }
    }
    stage('Build') {
      steps { 
        sh 'whoami' 
      }
    }
  }
}