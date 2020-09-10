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



