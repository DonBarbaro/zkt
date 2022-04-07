kubectl apply -f namespace.yaml 
kubectl apply -f statefulset.yaml -n skuska
kubectl apply -f service.yaml -n skuska
kubectl apply -f deployment.yaml -n skuska
kubectl apply -f ingress.yaml -n skuska