重复任务执行器
==============
根据html+jquery+php写的一个重复任务执行器

###用途
>repeatTask.php可以用来作为执行重复的任务，程序会采用ajax的方式向后台根据重复设定的时间间隔来请求这个地址
>repeatTaskMulti.php和上面的类似，但是可以重复执行多个任务。但是调用的时候似乎有些bug？
>repeatTask是利用setTimeout来达到重复执行的目的，但是repeatTaskMulti是通过setInterval来重复执行的

###关于
>不想在命令行执行php，用网页比较舒服
>可能对你没啥用，但是万一要是有用呢?