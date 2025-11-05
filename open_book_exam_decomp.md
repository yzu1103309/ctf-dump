```c
int __fastcall __noreturn main(int argc, const char **argv, const char **envp)
{
  int v3; // [rsp+Ch] [rbp-4h]

  init(argc, argv, envp);
  while ( 1 )
  {
    menu();
    write(1, &off_209F, 2u);
    v3 = read_int();
    puts(&byte_22AF); 
    if ( v3 == 4 )
      submit_ans();
    if ( v3 <= 4 )
    {
      switch ( v3 )
      {
        case 3:
          write_ans();
          goto LABEL_13;
        case 1:
          open_book();
          goto LABEL_13;
        case 2:
          read_book();
          goto LABEL_13;
      }
    }
    puts("Invalid operation");
LABEL_13:
    puts(&byte_22AF);
  }
}
```

```c
int menu()
{
  puts("what do you want to do?");
  puts("1. open book");
  puts("2. read book");
  puts("3. write answer");
  return puts("4. subit answer");
}
```

```c
void __noreturn submit_ans()
{
  puts("you have submitted answer bye~");
  exit(0);
}
```

```c
int read_int()
{
  char buf[24]; // [rsp+0h] [rbp-20h] BYREF
  unsigned __int64 v2; // [rsp+18h] [rbp-8h]

  v2 = __readfsqword(0x28u);
  read(0, buf, 0x10u);
  return atoi(buf);
}
```

```c
int write_ans()
{
  int result; // eax
  int v1; // [rsp+8h] [rbp-8h]

  puts("Q1. 1+1 = ?");
  puts("Q2. 100*100 = ?");
  puts("Q3. x-7 = 87, x=?");
  puts("Q4. 9/2+1 = ?");
  puts("which question do you want to write? (1~4)");
  write(1, &off_55555555609F, 2u);
  v1 = read_int();
  if ( v1 > 4 )
    return puts("Invalid operation!");
  write(1, "ans: ", 5u);
  result = read_int();
  questions[v1 - 1] = result;
  return result;
}
```

```c
int open_book()
{
  const char *v0; // rax
  int v2; // [rsp+Ch] [rbp-4h]

  puts("which book to open?");
  puts("1. Chinese");
  puts("2. Math");
  puts("3. Science");
  puts("4. English");
  puts("5. FLAG");
  write(1, &off_55555555609F, 2u);
  v2 = read_int();
  switch ( v2 )
  {
    case 1:
      book_fd = open("/home/open_book_exam/books/Chinese", 0);
      if ( book_fd == -1 )
      {
        puts("open book error");
        exit(0);
      }
      v0 = "Chinese";
      cur_book = "Chinese";
      break;
    case 2:
      book_fd = open("/home/open_book_exam/books/Math", 0);
      if ( book_fd == -1 )
      {
        puts("open book error");
        exit(0);
      }
      v0 = "Math";
      cur_book = "Math";
      break;
    case 3:
      book_fd = open("/home/open_book_exam/books/Science", 0);
      if ( book_fd == -1 )
      {
        puts("open book error");
        exit(0);
      }
      v0 = "Science";
      cur_book = "Science";
      break;
    case 4:
      book_fd = open("/home/open_book_exam/books/English", 0);
      if ( book_fd == -1 )
      {
        puts("open book error");
        exit(0);
      }
      v0 = "English";
      cur_book = "English";
      break;
    case 5:
      book_fd = open("/home/open_book_exam/books/FLAG", 0);
      if ( book_fd == -1 )
      {
        puts("open book error");
        exit(0);
      }
      v0 = "FLAG";
      cur_book = "FLAG";
      break;
    default:
      LODWORD(v0) = puts("Invalid operation!!");
      break;
  }
  return (int)v0;
}
```

```c
unsigned __int64 read_book()
{
  char buf[72]; // [rsp+10h] [rbp-50h] BYREF
  unsigned __int64 v2; // [rsp+58h] [rbp-8h]

  v2 = __readfsqword(0x28u);
  if ( book_fd == -1 )
  {
    puts("open one book before read it");
  }
  else if ( !strcmp(cur_book, "FLAG") )
  {
    puts("you can't read the content of FLAG!!");
  }
  else
  {
    puts("here is the content of book: ");
    buf[(int)read(book_fd, buf, 0x40u)] = 0;
    puts(buf);
  }
  return v2 - __readfsqword(0x28u);
}
```
