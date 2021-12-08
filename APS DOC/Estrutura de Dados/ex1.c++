#include <stdio.h>
#include <stdlib.h>

#define MAX 5

struct Earnings
{
    int itens[MAX];
    int tamanho;
    int inicio, fim;
}; 

struct Earnings* cria(void)
{
	struct Earnings* p;
	p = malloc(sizeof(struct Earnings));
	if(!p)
	{
		perror(NULL);
		exit(1);
	}
	p->inicio = 0;
	p->fim = 0;
}

void earningsInsere(Earnings *p, int x)
{
        p->itens[p->fim] = x;
        p->fim++;
        p->tamanho++;
}

int earningsRetira(Earnings *p)
{
    return p->itens[p->inicio++];
    p->tamanho--;
}



int main() 
{
    

    struct Earnings* id_earning = cria();
	struct Earnings* id_user = cria();
	struct Earnings* value = cria();

    earningsInsere(id_earning, 1);
    earningsInsere(id_user, 5);
    earningsInsere(value, 300);



}
