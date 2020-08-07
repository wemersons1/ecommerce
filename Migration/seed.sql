 insert into fornecedores(nome, logo, descricao, site) values("wemerson","logo da marca", "descrevendo o nome", "www.wemerson.com");
                      insert into produtos(nome, preco, imagem, descricao, id_fornecedor) values("notebook", 1000.00, "imagem.jpg", "descricao do produto", 1);

                      select * from produtos inner join fornecedores on produtos.id_fornecedor = fornecedores.id;

                      select produtos.nome, produtos.preco, produtos.imagem, produtos.descricao, fornecedores.nome, fornecedores.site from produtos inner join fornecedores on produtos.id_fornecedor=fornecedores.id;