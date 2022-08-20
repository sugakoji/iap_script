# 実行方法

- ビルド

docker image build -t hello-go-app .

- コンテナ実行

docker container run -d -p 8080:8080 hello-go-app

- dockerhub の push

docker tag hello-go-app docdocsugasuga/hello-go-app
docker push docdocsugasuga/hello-go-app
