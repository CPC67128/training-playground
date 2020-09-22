https://app.pluralsight.com/course-player?clipId=a872dce1-8314-4876-a236-45fdff6d1ff3


An Orchestrator for microservices apps
Like a coach of a soccer team
Don't run users workload on the master

Master is the brain of K8s

commands goes to apiserver using JSON

Nodes = Minions

Node:
* Kubelet : K8s agent, instantiates pods, reports back to master, registers nodes with cluster
* Container Engine: pulling images, start/stop containers
* kube-proxy: Networking - Pod IP addresses, all containers in a pod share single IP, load balances across all pods in a service

Give to a master a manifest file > describe desired state

Pod : atomic unit of scheduling

Containers always run inside of pods

Pods can have multiple containers (advanced use-case / Main & Sidecar) - All containers in pod share the pod environment

Pod never resurect: pending > running > succeeded / failed

Link between service (persistent DNS / IP) and pods is made through labels (like tags: 1.3, PROD, BackEnd)

```shell
$ kubectl get nodes
$ kubectl get pods
$ kubectl get pods/<pod_name>
$ kubectl get pods --all-namespaces

$ kubectl get rc -o wide

$ kubectl describe pods

$ kubectl create -f <file.yml>
$ kubectl apply -f <file.yml>

$ kubectl expose rc <name> --name=<name> --target-port=8080 --type=NodePort
$ kubectl describe svc <name>
```

Replication Controllers : scale pods, desired state

Deployments: RC + rolling updates, rollbacks

Services: stable networking



Minikube > Local k8s environment

Google Container Engine GKE > Packaged Kubernetes

AWS Provider

Manual Install
