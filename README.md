# Laravel User-based Task List

### 第一個Laravel的練習
為了瞭解一些Laravel的特性，直接實作一個可以註冊與登入的任務清單。參考了許多資源，畢竟主要是給自己學習用，因此以下我盡可能把做的事用白話文描述一次～

---


## 0. 安裝+開專案
詳細步驟就不寫了，我的環境是
```
macOS Catalina 10.15.3
PHP 7.4.6 
Laravel Framework 7.13.0
mysql  Ver 8.0.19 
```
原本還有載xampp，但因為環境設定不是很會用XD
最後是直接在終端機下command

## 1. Blade
從網路找了[模板](https://www.free-css.com/free-css-templates/page234/pure-mix)，把index.html的navbar, main, footer分開，讓每個網頁動態的extend主模板，就只需要改中間content的部分即可。

![](https://i.imgur.com/SN1A5q7.png)

本來想說開發時間如果只有一兩天的話，註冊/登入跟task list的功能分開做，但好像太沒有挑戰性XD
結果寫一寫才發現Laravel包山包海，上方navbar中的註冊登入的功能幾乎只有下指令`php artisan make:auth`加上套Boostrap cdn就做好了。

## 2. Database
開發中最有感的功能是schema跟migrate，我覺得能幫資料庫做版本控制對於學習真的非常友善！！！因為過程中我大概打掉重練了兩次、其中de大大小小bug也是數不清有幾次，資料庫不需要一直手動重建，還可以直接rollback真是太好了｡:.ﾟヽ(*´∀ˋ)ﾉﾟ.:｡


建立好Model後使用Eloquent ORM定義user與task的關係:
* an user hasMany task(s)
* a task belongs to an user

資料表上也是從table tasks掛一個foreign key到users.id上。


## 3. Registration & Login
這邊主要只有改登入後的頁面導向到task list page，其他都是使用default setting。

![](https://i.imgur.com/NOlXOln.png)

*（忘記密碼的功能有點...懶得研究，就從介面拔掉了）*

![](https://i.imgur.com/mib444c.png)

## 4. Task List
以下大概是跟task list有關的檔案。
```
|
├─resources
|  └─View
|     └─task.blade.php
└─Http
   ├─Controller
   |  └─TaskController.php
   └─Policy
      └─TaskPolicy.php
   
```
從view進入的user行為透過route進到controller，由於middleware會協助把user驗證都做好，並將該user限制在自己有權限的route底下，共有三個功能: 取得(index:get)、新增(store:post)、修改成已完成(update:patch)。其中最後一個功能中搭配著TaskPolicy，確認此task是被已授權的user進行修改。
*(不過我其實不懂在這邊擋的用意，因為view不是已經擋一層了嗎)*


![](https://i.imgur.com/HCAYm8Y.png)

新增成功
![](https://i.imgur.com/YeRNwEJ.png)

Task completed!
![](https://i.imgur.com/VrKDkmR.png)



## 5.後記
* 花最多時間的部分居然是在連資料庫...
* 雖然整個專案內的程式碼就是東拼西湊XD，一邊讀別人的code一邊想說可以拿來用，因此大多部分是只知道概念，要完全靠自己實作出來可能還是會有一些困難，但過程(debug)中還是發現了很多眉角，整個學習的過程只能說真的有驚艷到
* factory, seeder雖然都有寫，但並沒有使用到。因為這個功能相對很簡單，測試就只用了一個帳號，就沒有特別去跑指令

## 6. Reference:
* [Laravel Official Document(Traditional Chinese)](https://laravel.tw/docs/5.3) 居然有中文，看文件加速不少～太感動了XD
* [Udemy free course: Laravel 6 PHP Framework for Just Beginners](https://www.udemy.com/course/laravel-6-framework/)
* [Tutorial on Medium: Building a User-Based Task List Application in Laravel](https://medium.com/@brice_hartmann/building-a-user-based-task-list-application-in-laravel-eff4a07e2688)
