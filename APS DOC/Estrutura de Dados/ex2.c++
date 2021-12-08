#include <stdio.h>
#include <stdlib.h>

#define MAX 5

struct Credits
{
    int itens[MAX];
    int tamanho;
    int inicio, fim;
}; 

struct Credits* cria(void)
{
	struct Credits* p;
	p = malloc(sizeof(struct Credits));
	if(!p)
	{
		perror(NULL);
		exit(1);
	}
	p->inicio = 0;
	p->fim = 0;
}

void creditsInsere(Credits *p, int x)
{
        p->itens[p->fim] = x;
        p->fim++;
        p->tamanho++;
}

int creditsRetira(Credits *p)
{
    return p->itens[p->inicio++];
    p->tamanho--;
}



int main() 
{
    

    struct Credits* id_credit = cria();
	struct Credits* id_user = cria();
	struct Credits* value = cria();

    creditsInsere(id_credit, 1);
    creditsInsere(id_user, 5);
    creditsInsere(value, 300);



}
