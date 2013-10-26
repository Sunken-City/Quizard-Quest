#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
  static const char str[] = 
  "phpunit --stderr NegAPITest \n \
   phpunit --stderr APITest\n \
  ";
  system(str);
  return 0;
}
