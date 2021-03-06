SELECT *
FROM prodotto P
WHERE LEFT(codice_prodotto,2) = any (
				SELECT LEFT (codice_prodotto,2)
				FROM storico_acquisti AS S2 JOIN prodotto AS P2 on S2.ref_oggetto_SA=P2.codice_prodotto
				WHERE S2.ref_cliente_SA = 'lollo883@yahoo.it'  )
				GROUP BY LEFT (P2.codice_prodotto,2)
				HAVING sum(qty_acquistati_SA)>= 
								ALL(SELECT SUM(qty_acquistati_SA) AS TotaleAcquisti
						        WHERE S2.ref_cliente_SA = 'lollo883@yahoo.it'  )
                                FROM storico_acquisti S3 JOIN prodotto P3 on S3.ref_oggetto_SA=P3.codice_prodotto
								GROUP BY LEFT (P3.codice_prodotto,2)))
AND RIGHT (codice_prodotto,2)!=all(
				SELECT RIGHT (P2.codice_prodotto,2)
                FROM prodotto AS P2 JOIN  storico_acquisti S2 ON P2.codice_prodotto=S2.ref_oggetto_SA
                WHERE S2.ref_cliente_SA = 'lollo883@yahoo.it'  )
									
				