for ifile in $(ls)
do
iconv -f UTF-8 -t CP1251 $ifile -o tmpfile
mv tmpfile $ifile
done