New Media Design II 2017-2018
=============================

Opdracht iRent
--------------

### Installatie kloon

```
PS> c
PS> git clone »naam-van-de-repo« »naam-van-de-map«
PS> c »naam-van-de-map«
PS> git submodule update --init
PS> git submodule foreach 'git checkout v4-dev'
```


```
PS> c »naam-van-de-map«
PS> bundle update
PS> bundle exec jekyll serve
```

### Origineel

Als je aan een eigen project Bootstrap als een **Git Submodule** wil toevoegen.

```
PS> c
PS> mkdir »naam-van-de-map«
PS> c »naam-van-de-map«
PS> git submodule add --branch v4-dev --depth 1 https://github.com/twbs/bootstrap/ _vendor/bootstrap
```#1718-nmd2-code-irent
