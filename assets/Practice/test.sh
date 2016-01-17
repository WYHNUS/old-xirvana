#for i in {4..39}
#	do
#	if (( $i <= 9 ))
#	then 
#		index="0$i"
#	else
#		index="$i"
#	fi
#	FROM_DIR="practice${index}/practice${index}/"
#	TO_DIR="practice${index}/"
#	DELETE_DIR="practice${index}/practice$index"
#	mv ${FROM_DIR}* $TO_DIR
#	rmdir $DELETE_DIR
#	done

for i in {1..43}
   do
       if (( $i <= 9 ))
       then 
           index="0$i"
       else
           index="$i"
       fi
        dir_name="practice${index}"
        # new_dir_name="tmp"
        # cd $dir_name
        # mkdir $new_dir_name
        # chmod 777 tmp
        # cd ..

        cd "${dir_name}/testdata/output"
        j=1
        for file in *.out
        do
        	name=${file%%[.]*}
        	if (($j == 1))
        		then
		        	name_length=${#name}
		        	common_name=${name:0:${name_length}-1}
        	fi
        	# get index of test file
        	output_index=${name##$common_name}
        	mv "${common_name}${output_index}.out" "out${output_index}.out"
        	j=$(($j+1))
        done
        cd ../../..
    done
