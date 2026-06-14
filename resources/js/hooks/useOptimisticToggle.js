import { useCallback, useRef, useState } from 'react';
import { api } from '../api/axios';

export function useOptimisticToggle(initialItems = []) {
    const [items, setItemsState] = useState(initialItems);
    const [pendingToggles, setPendingTogglesState] = useState({});
    const itemsRef = useRef(initialItems);
    const pendingTogglesRef = useRef({});

    const setItems = useCallback((value) => {
        setItemsState(prev => {
            const next = typeof value === 'function' ? value(prev) : value;

            itemsRef.current = next;

            return next;
        });
    }, []);

    const setPendingToggles = useCallback((value) => {
        setPendingTogglesState(prev => {
            const next = typeof value === 'function' ? value(prev) : value;

            pendingTogglesRef.current = next;

            return next;
        });
    }, []);

    const toggleItem = useCallback(async (id) => {
        if (pendingTogglesRef.current[id]) {
            return;
        }

        const currentStatus = itemsRef.current.find(item => item.id === id)?.is_owned;

        if (currentStatus === undefined) {
            return;
        }

        setPendingToggles(prev => ({ ...prev, [id]: true }));

        setItems(prev =>
            prev.map(item =>
                item.id === id
                    ? { ...item, is_owned: !item.is_owned }
                    : item
            )
        );

        try {
            await api.patch(`/stickers/${id}/toggle`);
        } catch (err) {
            console.error('Error toggling sticker:', err);

            setItems(prev =>
                prev.map(item =>
                    item.id === id
                        ? { ...item, is_owned: currentStatus }
                        : item
                )
            );
        } finally {
            setPendingToggles(prev => {
                const next = { ...prev };
                delete next[id];

                return next;
            });
        }
    }, [setItems, setPendingToggles]);

    return {
        items,
        setItems,
        pendingToggles,
        toggleItem,
    };
}
