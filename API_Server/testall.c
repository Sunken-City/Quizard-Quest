#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
  static const char str[] = 
  "phpunit --stderr APITest \n \
   phpunit --stderr NegAPITest\n \
  ";
  system(str);
  return 0;
}
