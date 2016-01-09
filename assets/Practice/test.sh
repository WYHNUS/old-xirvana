for i in {4..39}
	do
	if (( $i <= 9 ))
	then 
		index="0$i"
	else
		index="$i"
	fi
	FROM_DIR="practice${index}/practice${index}/"
	TO_DIR="practice${index}/"
	DELETE_DIR="practice${index}/practice$index"
	mv ${FROM_DIR}* $TO_DIR
	rmdir $DELETE_DIR
	done

